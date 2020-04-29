<?php
/**
 * Plugin Name: LeccionesWP Books
 * Description: Plugin realizado como apoyo para tutoriales de LeccionesWP.
 * Version:     1.0.0
 * Author:      Antonio Glz
 * Author URI:  https://leccioneswp.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: llwp_books
 *
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with This plugin. If not, see {URI to Plugin License}.
 *
 * @package My Core Plugin
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Activation
 *
 * Acciones que se deben ejecutar al activar el plugin.
 * - Refresca los enlaces permanentes.
 *
 * @return void
 */
function llwp_activate() {
	/**
	 * "Agregamos" el custom post type para que los rewrite rules lo tomen en cuenta
	 * a la hora de refrescar los enlaces permanentes.
	 * Realmente no se va a registrar el custom post type para nuestro uso,
	 * eso se hará enlazandolo a otro hook más adelante.
	 */
	llwp_books_register_post_type();
	// Refrescamos los enlaces permanentes.
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'llwp_activate' );

/**
 * Deactivation
 *
 * Acciones que se deben ejecutar al desactivar el plugin.
 * - Refresca los enlaces permanentes.
 *
 * @return void
 */
function llwp_deactivate() {
	// Refrescamos los enlaces permanentes.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'llwp_deactivate' );

/**
 * Post Type
 *
 * Agrega el Custom Post Type de Books/Libros
 *
 * @return void
 */
function llwp_books_register_post_type() {
	// Etiquetas.
	$labels = array(
		'name'             => __( 'Libros', 'llwp_books' ),
		'singular_name'    => __( 'Libro', 'llwp_books' ),
		'add_new'          => __( 'Añadir nuevo', 'llwp_books' ),
		'add_new_item'     => __( 'Añadir nuevo libro', 'llwp_books' ),
		'edit_item'        => __( 'Editar libro', 'llwp_books' ),
		'new_item'         => __( 'Nuevo libro', 'llwp_books' ),
		'view_item'        => __( 'Ver libro', 'llwp_books' ),
		'view_items'       => __( 'Ver libros', 'llwp_books' ),
		'search_items'     => __( 'Buscar libros', 'llwp_books' ),
		'all_items'        => __( 'Todos los libros', 'llwp_books' ),
		'insert_into_item' => __( 'Añadir al libro', 'llwp_books' ),
	);
	// Argumentos.
	$args = array(
		'labels'        => $labels,
		'description'   => __( 'Libros de la biblioteca', 'llwp_books' ),
		'public'        => true,
		'hierarchical'  => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_position' => 25,
		'menu_icon'     => 'dashicons-book',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
		'rewrite'       => array(
			'slug' => __( 'libro', 'llwp_books' ),
		),
	);
	register_post_type( 'book', $args );
}
add_action( 'init', 'llwp_books_register_post_type' );
