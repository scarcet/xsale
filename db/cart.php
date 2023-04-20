<?php
class Cart extends Users{

    public $id;
    public $pro_name;
    public $pro_price;
    public $pro_qty;
    public $pro_size;
    public $pro_category;
    public $pro_datepost;
    public $pro_img;

    public $count_cart;

    public function __construct()
    {
        $this->tocount_cart();
    }

    public function remove($id){
        foreach($_SESSION['cart'] as $keys=> $values){
            if($id == $values['id']){
                unset($_SESSION['cart'][$keys]);
            }
        }
    }

    public function add_cart($item_array){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'][] = $item_array;
        }
        else{
            if($this->tocheck_itemadded($item_array) == true){
                return;
            }
            else{
            $_SESSION['cart'][] = $item_array;
            }

        }

    }

    public function findall_cart(){
        if(isset($_SESSION['cart'])){
            $cart_array = array();
            foreach($_SESSION['cart'] as $result){
                $cart_array[] = $this->instatation($result);

            }
        }
        return $cart_array;
    }

    public function instatation($theresult){
        $calling_class = get_called_class();
        $called_class = new $calling_class;
        $obj_var = get_object_vars($called_class);
        foreach($theresult as $key=> $value){
            if(array_key_exists($key, $obj_var)){
            $called_class->$key = $value;
            }
        }
        return $called_class;

    }
    public function tocheck_itemadded($item_arr){
        foreach($_SESSION['cart'] as $item){
            if($item['id'] == $item_arr['id']){
                keepmsg("item already added");
                return true;
            }

        }
    }

    public function tocount_cart(){
        if(isset($_SESSION['cart'])){
            $items = $_SESSION['cart'];
            return $_SESSION['count'] = count($items);
        }
    }

    public function total_pro(){
        $qty = 0 ;
        foreach($_SESSION['cart'] as $item){
            $qty += $item['pro_qty'];
        }
        return $qty;
    }

    public function totalamt(){
        $total = 0;
        foreach($_SESSION['cart'] as $item){
            $total += $item['pro_price'] * $item['pro_qty'];

    }
    return $total;
    }


}
$cart = new Cart();







      //   if(isset($_POST['add_cart'])){
      //     $item = array(
      //       'id' => $pro->id,
      //       'name' => $pro->pro_name,
      //       'price' =>$pro->pro_price
      //     );
        
      //   if(!isset($_SESSION['cart'])){
      //     $_SESSION['cart'][] = $item;
          
      //   $items = $_SESSION['cart'];
      //   $count_cart =  count($items);
      //   echo $_SESSION['coun'] = $count_cart;
      //   }
      //   else{
      //     foreach($_SESSION['cart'] as $prod){
      //       if($prod['id'] == $item['id']){
      //       echo "item already added";
      //       return;
            
      //     }
      //   }
      //   $_SESSION['cart'][] = $item;
      //   $items = $_SESSION['cart'];
      //   $count_cart =  count($items);
      //   echo $_SESSION['coun'] = $count_cart;
      //   }
      // }
      // foreach($_SESSION['cart'] as $product){
      //   echo $product['name'];
      // }
?>