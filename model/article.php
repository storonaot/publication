<?php
	class Model_article extends Model_publication{
		public function __construct($id) {
      $this->table = 'article';

			$rate = Controller_DB::getObject(
				'rate',
				array('rate' => 'rate'),
				array('article_id' => $id)
			);

			function get_rate($rate) {
			    return $rate->rate;
			}

			$rate = array_map('get_rate', $rate);

			$rateCount = count($rate);
			$rateSum = array_sum($rate);

			$this->rate = $rateCount > 0 ? round($rateSum / $rateCount, 1) : 0;
			$this->rateCount = $rateCount;

      parent::__construct($id);
		}
		public static function edit($info = array(), $id = 0) {
			if (!empty($info)) {
				return Controller_DB::update('article', $info, array('id' => $id));
			}
			else {
				return true;
			}
		}

		public static function remove($id = 0) {
			if ($id > 0) {
				return Controller_DB::delete('article', array('id' => $id));
			}
			else {
				return true;
			}
		}
  }
?>
