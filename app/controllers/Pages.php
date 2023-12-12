<?php
    class Pages extends Controller {
        public function index() {
            $this->view('pages/index');
        }

        public function movies() {
            $this->view('pages/movies');
        }
    }