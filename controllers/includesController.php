<?php
	require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/includesModel.php";

    class IncludesController{

		public function MenuSidebar(){
            return IncludesModel::MenuSidebar();
        }
    }