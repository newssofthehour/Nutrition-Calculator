<?php
	class Article {
		private $title; // article title
		private $link; // article URL
		private static $count = 0; // Counts article objects created

		// Constructor
		public function __construct($title, $link) {
			$this->set_title($title);
			$this->set_link($link);
			self::$count++; 
		}

		// Getters
		public function get_title() {
			return $this->title;
		}
		public function get_link() {
			return $this->link;
		}
		public static function get_count() {
			return self::$count;
		}

		// Setters
		public function set_title($title) {
			$this->title = $title;
		}
		public function set_link($link) {
			$this->link = $link;
		}

		// Print article details on single line
		public function __toString() {
			return $this->title . ": " . $this->link;
		}
	}
?>