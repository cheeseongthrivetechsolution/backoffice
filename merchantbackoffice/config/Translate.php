<?php
	class Translate {
		//Get Translate
		public function getMessage($lang) {
			$message = file_get_contents("../../translate/".$lang.".json");
			$message = preg_replace( '![ \t]*//.*[ \t]*[\r\n]!', '', $message );
			$message = json_decode( $message, true );
			
			return $message;
		}
	}
