(function ( $ ) {

	function slider() {
		let slider = $( '.js-slider' );
		let slide  = slider.attr( 'data-active-slide' ) ? slider.attr( 'data-active-slide' ) : 0;
		slider.attr( 'data-active-slide', slide );
	}

	slider();

	// слушаем событие клик по "точке" слайдера
	$( '.js-slider-dot' ).on( 'click', function ( event ) {

		// определяем индекс точки, по которой был осуществлен клик
		let index = $( this ).attr( 'data-index' );

		// сохраняем текущий объект в переменную
		let that = this;

		// удаляем класс active у каждой "точки"
		$( '.js-slider-dot' ).each( function () {
			$( this ).removeClass( 'active' );
		} );

		// ищем ближайший родительский элемент с классом js-slider
		$( that ).closest( '.js-slider' )
		         // в родительском элементе с указанным классом ищем дочерний эл-т
		         // с классом js-slider-slide
		         .find( '.js-slider-slide' )
		         // для каждого найденного элемента выполняем следующие действия
		         .each( function () {

			         // определяем значение атрибута текущего слайда
			         let slide = $( this ).attr( 'data-slide' );

			         // сравниваем значение атрибутов "точки" и текущего слайда
			         if ( index === slide ) {

				         // если они совпали, то делаем слайд активным
				         $( this ).addClass( 'active' );
			         } else {

				         // "выключаем" слайд
				         $( this ).removeClass( 'active' );
			         }

		         } );

		// делаем "точку", на которую кликнули6 активной
		$( that ).addClass( 'active' );
	} );

	function cl( data ) {
		console.log( data );
	}


	function nextSlide( selector, index, time ) {

		let count = $( selector ).find( '.js-slider-slide' ).length;
		cl( 'count: ' + count );
		if ( index >= count ) {
			index = 0;
		}
		cl( 'index: ' + index );

		$( selector ).find( '.js-slider-slide, .js-slider-dot' ).each(function (  ) {
			// "выключаем" слайд
			$( this ).removeClass( 'active' );
		});

		$( selector ).find( '.js-slider-slide, .js-slider-dot' )
		             // для каждого найденного элемента выполняем следующие действия
		             .each( function () {

			             // определяем значение атрибута текущего слайда
			             let slide = parseInt( $( this ).attr( 'data-slide' ) );
			             let dot   = parseInt( $( this ).attr( 'data-index' ) );
			             cl( slide + ' - ' + dot );
			             // сравниваем значение атрибутов "точки" и текущего слайда
			             if ( index === slide || index === dot ) {

				             // если они совпали, то делаем слайд активным
				             $( this ).addClass( 'active' );
			             }/* else {
				             //cl( $( this ));
				             // "выключаем" слайд
				             $( this ).removeClass( 'active' );
			             }*/

		             } );


		setTimeout( function () {
			nextSlide( '.js-slider', ++index, time );
		}, time * 1000 );
	}

	nextSlide( '.js-slider', 1, 5 );

}( jQuery ));
