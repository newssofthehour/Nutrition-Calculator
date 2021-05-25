<?php
	class Meal {
		private $name;
		private $ingredients = array(); // list of ingredients
		private $ingredientAmount = array(); // amount of each ingredient in <ingredients> list.
		private $calories, $sodium; // ints
		private $fat, $carbs; // floats

		public function __construct($name) {
			$this->set_name($name);
		} 

		// Setters
		public function set_name($name) {
			$this->name = $name;
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

		// Adds ingredient to ingredient list, amount to ingredientAmount list
		public function add($ingredient,$amount) {
			array_push($this->ingredients,$ingredient);
			array_push($this->ingredientAmount,$amount);
			$this->calculate_total(); // Recalculate total when new ingredients are added to the meal
		}

		// Removes ingredient if found
		public function remove($ingredient) {
			$index = -1;
			for($i = 0; $i < $this->get_size(); $i++) {
				if($ingredient->get_calories() == $this->ingredients[$i]->get_calories() &&
					$ingredient->get_fat() == $this->ingredients[$i]->get_fat() &&
					$ingredient->get_carbs() == $this->ingredients[$i]->get_carbs() &&
					$ingredient->get_sodium() == $this->ingredients[$i]->get_sodium()) {
					$index = $i;
				}
			}
			if($index >= 0) { // if item matched
				unset($this->ingredients[$index]); // remove item
				$this->ingredients = array_values($this->ingredients); // reindex array
				unset($this->ingredientAmount[$index]);
				$this->ingredientAmount = array_values($this->ingredientAmount);
				$this->calculate_total();
			}
		}

		// Get amount of ingredients in meal
		public function get_size() {
			return count($this->ingredients);
		}

		public function get_ingredients() {
			return $this->ingredients;
		}

		public function get_ingredientAmount() {
			return $this->ingredientAmount;
		}

		/* This function calculates the total amount of calories in the meal */
		public function calculate_total() {
			$this->calories = $this->fat = $this->carbs = $this->sodium = 0; // Reset to 0 
			for($i = 0; $i < $this->get_size(); $i++) { // Calculate
				$this->calories += round($this->ingredients[$i]->get_calories() * ($this->ingredientAmount[$i]/100));
				$this->fat += round($this->ingredients[$i]->get_fat() * ($this->ingredientAmount[$i]/100),2);
				$this->carbs += round($this->ingredients[$i]->get_carbs() * ($this->ingredientAmount[$i]/100),2);
				$this->sodium += round($this->ingredients[$i]->get_sodium() * ($this->ingredientAmount[$i]/100));
			}
		}


		public function __toString() {
			return "Meal: " . $this->get_name() . " Calories: " . $this->get_calories() . 
					" Fat: " . $this->get_fat() . " Carbs: " . $this->get_carbs() . " Sodium: " . $this->get_sodium();
		}
	}
?>