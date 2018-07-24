
  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Hello extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
      
	}

    function index()
    {
        echo "hello";
    }
    function test()
    {
        echo "test";
    }
	

}

                     



 ?>
