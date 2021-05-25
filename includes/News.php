<?php
	class News {
		private $articleList = array(); // list of articles
		private static $instance = null; // track creation of News object

		// Constructor 
		private function __construct() {
			// News is singleton and constructor is therefore private
			// See getInstance method
		} 

		// Create instance if none found
		public static function get_instance() {
			// If no instance of News, create new
			if (self::$instance === null) {
				self::$instance = new self();
			}
			// Otherwise, return existing instance
			return self::$instance;
		}

		// Create Article and store in $articleList
		public function add_article($title, $link) {
			$this->articleList[Article::get_count()] = new Article($title, $link);
		}

		// Update existing article
		public function update_article($index, $title, $link) {
			$this->articleList[$index]->set_title($title);
			$this->articleList[$index]->set_link($link);
		}

		// Sort list of Articles by title
		public function sort_articles() {
			//sort($articleList);
		}

		// Remove article entry from News
		public function remove_article($index) {
			unset($this->articleList[$index]);
			$this->articleList = array_values($this->articleList); // Reindex array
		}

		public function get_articles() {
			return $this->articleList;
		}

		// Print article titles and links, one per line
		public function __toString() {
			$articles = "";
			for ($i = 0; $i < Article::get_count(); $i++) {
				$articles = $articles . $this->articleList[$i]->toString() . "\n";
			}
		}
	}
?>