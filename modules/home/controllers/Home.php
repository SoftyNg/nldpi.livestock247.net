<?php

class Home extends Trongate {



	/**

	 * Renders the (default) homepage for public access.

	 *

	 * @return void

	 */

	public function index(): void {

		$data['view_module'] = 'home';

		$data['view_file'] = 'home';

		$data['title'] = 'Home';

		$this->template('public', $data);

	}


}