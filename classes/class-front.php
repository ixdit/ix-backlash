<?php

namespace IXBL;

class Front {

	public function init_hooks(): void {

		add_filter( 'the_content', [ $this, 'add_backlash_before_content' ] );
//		add_filter( 'the_content', [ $this, 'add_backlash_after_content' ] );

	}

	public function add_backlash_before_content( $content ): string {

		//TODO: убрать алтьернативное написание
		if ( is_single()):

		ob_start();

		global $post;

		echo $content;

		load_template(
			ixbl()->templater->get_template( 'layout1.php' ),
			true,
			get_the_ID()
		);

		$newcontent = ob_get_clean();

		return $newcontent;

		else:

		return $content;

		endif;
	}

	/**
	 * вывод рекций перед контентом
	 * TODO: доделать
	 */
//	public function add_backlash_after_content( $content ): string {
//
//		$newcontent = 'test' . $content;
//
//		return $newcontent;
//	}

}