<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-search-cover" method="get">
    <div class="qodef-form-holder">
        <div class="qodef-search-icon">
		<?php echo topscorer_core_get_search_icon_html(); ?>
        </div>
        <input type="text" placeholder="<?php esc_attr_e( 'Type your search...', 'topscorer-core' ); ?>" name="s"
               class="qodef-search-field" autocomplete="off" required/>

        <a class="qodef-search-close <?php echo topscorer_core_get_open_close_icon_class( 'qodef_search_icon_source', 'qodef-search-close' ); ?>"
           href="javascript:void(0)">
			<?php echo topscorer_core_get_search_icon_html( true ); ?>
        </a>

    </div>
</form>