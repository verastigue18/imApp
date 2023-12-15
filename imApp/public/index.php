<?php


require('../configs/functions.php');
const BASE_PATH = __DIR__ . '\\..\\';


require base_path('configs/Database.php');
require_once base_path('models/UserModel.php');
require_once base_path('models/OrderModel.php');
require_once base_path('models/CustomerModel.php');
require_once base_path('models/ProductModel.php');
require base_path('configs/router.php');
