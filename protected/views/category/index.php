<div class="cat-well1">

    <?php
    $this->widget( 'bootstrap.widgets.TbListView', array(
            'dataProvider' => $dataProvider,
            'itemView'     => '_view',
            'htmlOptions' => array('class' => 'cat-cont'),
            'summaryText' => false
        )
    );


    ?>
</div>
<div class="cat-well2">
    <?php $text = t( 'Take course' );
    echo CHtml::link( $text, array( 'register/create' ), array( 'class' => 'cat-index-reg-btn' ) ); ?>
    <a style="position:relative; cursor: pointer; text-decoration: none;" target="_blank" href="https://www.avtoizpit.com/listovki">
        <img width="453" height="136" border="0" title="Oнлайн листовки от Avtoizpit.com" alt="Листовки онлайн от Avtoizpit.com" src="https://avtoizpit.com/links/link_dark453x136.png">
    </a>

</div>