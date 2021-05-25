<?php
	class Ingredient {
		private $name; // String
		private $calories, $sodium; // Ints
		private $fat, $carbs; // Floats

		// Constructor
		public function __construct($name,$calories,$fat,$carbs,$sodium) {
			$this->set_name($name);
			$this->set_calories($calories);
			$this->set_fat($fat);
			$this->set_carbs($carbs);
			$this->set_sodium($sodium);
		}

		// Setters
		public function set_name($name) {
			$this->name = $name;
		}
		public function set_calories($calories) {
			$this->calories = $calories;
		}
		public function set_fat($fat) {
			$this->fat = $fat;
		}
		public function set_carbs($carbs) {
			$this->carbs = $carbs;
		}
		public function set_sodium($sodium) {
			$this->sodium = $sodium;
		}

		// Getters
		public function get_name() {
			return $this->name;
		}
		public function get_calories() {
			return $this->calories;
		}
		public function get_fat() {
			return $this->fat;
		}
		public function get_carbs() {
			return $this->carbs;
		}
		public function get_sodium() {
			return $this->sodium;
		}

		// Override toString()
		public function __toString() {
			return $this->name . " " . $this->calories . " "
			. $this->fat . " " . $this->carbs . " " . $this->sodium;
		}

	}
?>