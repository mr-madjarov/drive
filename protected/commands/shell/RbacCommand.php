<?php

class RbacCommand extends CConsoleCommand
{
    const DESCRIPTION = 'description';
    const BIZRULE = 'bizRule';
    const DATA = 'data';

    private $_operations = array(
        // User related operations
        'aUserCreate'             => array(
            self::DESCRIPTION => 'Create user',
            self::BIZRULE     => null,
            self::DATA        => null
        ),
        'aUserUpdate'             => array( self::DESCRIPTION => 'Update user' ),
        'aUserView'               => array( self::DESCRIPTION => 'View user' ),
        'aUserDelete'             => array( self::DESCRIPTION => 'Delete user' ),
        'aUserAdmin'              => array( self::DESCRIPTION => 'Manage users' ),
        'aUserProfile'            => array( self::DESCRIPTION => 'View user profile' ),
        'aUserEditProfile'        => array( self::DESCRIPTION => 'Edit user profile' ),
        //Config related operations
        'aConfigFirm'             => array( self::DESCRIPTION => 'Edit firm information' ),
        'aConfigEmail'            => array( self::DESCRIPTION => 'Edit email configuration' ),
        'aConfigCount'            => array( self::DESCRIPTION => 'Edit document counters information' ),
        //CoordinateConfig related operations
        'aCoordinateConfigUpdate' => array( self::DESCRIPTION => 'Update coordinates' ),
        // other operations
        'aAdminPanelIndex'        => array( self::DESCRIPTION => 'Access the admin panel', ),
        'aPriceListIndex'         => array( self::DESCRIPTION => 'Access the price list', )
    );

    private $_tasks = array(

        // User related tasks
        'tManageUsers'        => array(
            self::DESCRIPTION => 'Manage users (create, update, delete)',
            self::BIZRULE     => null,
            self::DATA        => null
        ),
        'tEditOwnProfile'     => array(
            self::DESCRIPTION => 'Update own profile',
            self::BIZRULE     => 'return $params["user"]->id == Yii::app()->user->id;',
        ),
        'tViewUsers'          => array( self::DESCRIPTION => 'View users', ),
        //Config related tasks
        'tEditConfigurations' => array( self::DESCRIPTION => 'Edit application configurations (firm, email, counters, coordinates)', ),
        // other tasks
        'tEditPriceLists'     => array( self::DESCRIPTION => 'Edit price list' ),
    );

    private $_roles = array(
        'systemAdministrator' => array(
            self::DESCRIPTION => 'System Administrator',
            self::BIZRULE     => null,
            self::DATA        => null
        ),
        'manager'             => array( self::DESCRIPTION => 'Manager' ),
        'operator'            => array( self::DESCRIPTION => 'Operator' ),
    );

    private $_taskAssignments = array(
        'tManageUsers'        => array(
            'aUserCreate',
            'aUserUpdate',
            'aUserDelete',
            'aUserAdmin',
            'aUserProfile',
            'aUserEditProfile'
        ),
        'tViewUsers'          => array( 'aUserView', 'aUserProfile' ),
        //Config
        'tEditConfigurations' => array(
            'aConfigFirm',
            'aCoordinateConfigUpdate',
            'aConfigEmail',
            'aConfigCount',
            'aPriceListIndex'
        ),
        'tEditPriceLists'     => array( 'aPriceListIndex' ),
        //User profile
        'tEditOwnProfile'     => array( 'aUserEditProfile', 'aUserUpdate' )

    );

    private $_roleAssignments = array(
        'systemAdministrator' => array(
            'tManageUsers',
            'tViewUsers',
            'aAdminPanelIndex',
            'tEditConfigurations'
        ),
    );

    /** @var DbAuthManager */
    private $_authManager;

    public function getHelp()
    {
        return <<<'EOT'

USAGE
  rbac [-r]

DESCRIPTION
  This command generates the default RBAC authorization hierarchy for Bridge.bg.

OPTIONS
  -r    Forces the command to delete roles even if they have active
        assignments to users, i.e. users will lose their role assignments.
        Use this option only when it is OK to lose existing role-to-user
        assignments, e.g. during development, but not in production deployments.

EOT;
    }

    public function run( $args )
    {
        //ensure that an authManager is defined as this is mandatory for creating an auth hierarchy
        if ( ( $this->_authManager = Yii::app()->authManager ) === null ) {
            echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
            echo "If you already added 'authManager' component in application configuration,\n";
            echo "please quit and re-enter the yiic shell.\n";
            return;
        }

        //provide the opportunity for the use to abort the request
        echo "\nThis command will create the default roles, tasks, and operations.\n";
        //echo "\nWould you like to continue? [y/N]: ";

        //check the input from the user and continue if they indicated yes to the above question
        //if ( !strncasecmp( trim( fgets( STDIN ) ), 'y', 1 ) ) {

        if ( !$this->canDeleteRoles( $args ) ) {
            echo "\nThe command will exit (no changes were made).";
            return;
        }

        $transaction = Yii::app()->db->beginTransaction();

        // first we need to remove all the default roles along with their associated tasks and operations
        $this->deleteAuthItems();

        // create the auth items
        $this->createAuthItems();

        // update existing auth items
        $this->updateAuthItems();

        // assign operations to tasks
        $this->assignAuthItems( $this->_taskAssignments );

        // assign tasks to roles
        $this->assignAuthItems( $this->_roleAssignments );

        $transaction->commit();

        //provide a message indicating success
        echo "\nAuthorization hierarchy successfully generated.";
        //}

    }

    private function canDeleteRoles( $args )
    {
        // Allow role deletion if the -r option has been given
        /*if ( in_array( '-r', $args ) ) {
            return true;
        }*/

        // Check if there are roles that are assigned to users
        $existingRoles = $this->_authManager->getRoles();
        $rolesToDelete = array_diff_key( $existingRoles, $this->_roles );
        foreach ( $rolesToDelete as $name => $data ) {
            if ( $this->_authManager->isAuthItemAssigned( $name ) ) { // the role is assigned to at least one user
                echo "\n[WARN] The role '" . $name . "' cannot be deleted because it is assigned to at least one user.\n";
                return false;
            }
        }
        return true;
    }

    private function deleteAuthItems()
    {
        // Delete operations.
        // This will also delete all referenced records in {{auth_item_child}} and {{auth_assignment}}
        $operations = $this->_authManager->getOperations();
        foreach ( $operations as $name => $data ) {
            $this->_authManager->removeAuthItem( $name );
        }

        // Delete tasks.
        // This will also delete all referenced records in {{auth_item_child}} and {{auth_assignment}}
        $tasks = $this->_authManager->getTasks();
        foreach ( $tasks as $name => $data ) {
            $this->_authManager->removeAuthItem( $name );
        }

        // Delete roles.
        // Delete only those roles, which have been removed from the $_roles array above.
        $existingRoles = $this->_authManager->getRoles();
        $rolesToDelete = array_diff_key( $existingRoles, $this->_roles );
        foreach ( $rolesToDelete as $name => $data ) {
            $this->_authManager->removeAuthItem( $name );
        }
    }

    private function createAuthItems()
    {
        // create the operations
        foreach ( $this->_operations as $name => $data ) {
            $this->_authManager->createOperation( $name, $data[ self::DESCRIPTION ],
                isset( $data[ self::BIZRULE ] ) ? $data[ self::BIZRULE ] : null,
                isset( $data[ self::DATA ] ) ? $data[ self::DATA ] : null
            );
        }

        // create the tasks
        foreach ( $this->_tasks as $name => $data ) {
            $this->_authManager->createTask( $name, $data[ self::DESCRIPTION ],
                isset( $data[ self::BIZRULE ] ) ? $data[ self::BIZRULE ] : null,
                isset( $data[ self::DATA ] ) ? $data[ self::DATA ] : null
            );
        }

        // Create the roles.
        // Create only those roles, which are not existing already.
        $existingRoles = $this->_authManager->getRoles();
        $rolesToCreate = array_diff_key( $this->_roles, $existingRoles );
        foreach ( $rolesToCreate as $name => $data ) {
            $this->_authManager->createRole( $name, $data[ self::DESCRIPTION ],
                isset( $data[ self::BIZRULE ] ) ? $data[ self::BIZRULE ] : null,
                isset( $data[ self::DATA ] ) ? $data[ self::DATA ] : null
            );
        }

        // Assign role 'systemAdministrator' to user with ID 1
        if ( !$this->_authManager->isAssigned( 'systemAdministrator', 1 ) ) {
            $this->_authManager->assign( 'systemAdministrator', 1 );
        }
    }

    private function updateAuthItems()
    {
        $existingRoles = $this->_authManager->getRoles();

        /** @var CAuthItem[] $rolesToUpdate */
        $rolesToUpdate = array_intersect_key( $existingRoles, $this->_roles );

        foreach ( $rolesToUpdate as $role ) {
            $role->setDescription( $this->_roles[ $role->name ][ self::DESCRIPTION ] );
            if ( !empty( $this->_roles[ $role->name ][ self::BIZRULE ] ) ) {
                $role->setBizRule( $this->_roles[ $role->name ][ self::BIZRULE ] );
            }
            if ( !empty( $this->_roles[ $role->name ][ self::DATA ] ) ) {
                $role->setData( $this->_roles[ $role->name ][ self::DATA ] );
            }
            $this->_authManager->saveAuthItem( $role );
        }
    }

    private function assignAuthItems( $assignments )
    {
        foreach ( $assignments as $parent => $children ) {
            foreach ( $children as $child ) {
                $this->_authManager->addItemChild( $parent, $child );
            }
        }
    }
}
