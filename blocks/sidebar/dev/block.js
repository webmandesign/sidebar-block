/**
 * Block editor script.
 *
 * @package    Sidebar Block
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  1.0.0
 */

( ( wp ) => {
	'use strict';

	// Variables

		const
			Editor  = wp.blockEditor,
			Comp    = wp.components,
			Element = wp.element.createElement;


	// Processing

		wp.blocks.registerBlockType( 'wmd/sidebar', {

			edit: ( props ) => {

				// Variables

					const
						{ sidebarOptions, sidebarNames, texts } = wmdSidebarBlock,
						{ id }                                  = props.attributes;


				// Output

					return Element(

						/**
						 * Preview wrapper container.
						 */
						'div',
						Editor.useBlockProps( {
							className: ( id ) ? ( 'has-sidebar-selected' ) : ( '' ),
						} ),

						/**
						 * Preview inner elements.
						 */

							// Icon.
							Element( 'span', { className: 'icon' }, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M18 5.5H6a.5.5 0 00-.5.5v3h13V6a.5.5 0 00-.5-.5zm.5 5H10v8h8a.5.5 0 00.5-.5v-7.5zM6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"></path></svg> ),

							// Description text.
							Element( 'span', { className: 'description' }, ( ( id ) ? ( texts.contentIsId ) : ( texts.contentNoId ) ) ),

							// PHP code preview.
							( id ) ? ( ( sidebarNames[ id ] ) ? ( Element( 'strong', {}, '"' + sidebarNames[ id ] + '"' ) ) : ( Element( 'code', {}, id ) ) ) : ( '' ),

						/**
						 * Block settings sidebar.
						 */
						Element( Editor.InspectorControls, {},
							Element( Comp.PanelBody, {},
								Element( Comp.SelectControl,
									{
										label    : texts.optionIdLabel,
										value    : id,
										help     : texts.optionIdDesc,
										options  : sidebarOptions,
										onChange : ( newValue ) => props.setAttributes( { id: newValue } ),
									}
								),
							),
						)
					);
			},

			save: function () {

				// Processing

					// No need to output anything, just save the options.
					Editor.useBlockProps.save();
			},

			icon: <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M18 5.5H6a.5.5 0 00-.5.5v3h13V6a.5.5 0 00-.5-.5zm.5 5H10v8h8a.5.5 0 00.5-.5v-7.5zM6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"></path></svg>,

		} );

} )( window.wp );
