<?php
require_once('DBConnect.php');

class CheckoutModel extends DBConnect{

	public function insertCustomer($name,$email,$address,$phone){
		$sql = "INSERT INTO customers(name,email,address,phone)
				VALUES('$name','$email','$address','$phone')";
		$this->setQuery($sql);
		if($this->executeQuery()){
			return $this->getLastId();
		}
		return false;
	}
	public function insertBill($idCustomer,$dateOrder,$total,$note,$token,$tokenDate){
		$sql = "INSERT INTO bills(id_customer,date_order,total,note,token,token_date)
				VALUES($idCustomer,'$dateOrder',$total,'$note','$token','$tokenDate')";
		$this->setQuery($sql);
		if($this->executeQuery()){
			return $this->getLastId();
		}
		return false;
	}
	public function insertBillDetail($idBill,$idFood,$qty,$price){
		$sql = "INSERT INTO bill_detail(id_bill,id_food,quantity,price)
				VALUES('$idBill','$idFood','$qty','$price')";
		$this->setQuery($sql);
		return $this->executeQuery();
	}
	public function delRecentInsertCus($idCustomer){
		$sql = "DELETE FROM customers WHERE id=$idCustomer";
		$this->setQuery($sql);
		return $this->executeQuery();
	}
	public function delRecentInsertBill($idBill){
		$sql = "DELETE FROM bills WHERE id_bill=$idBill";
		$this->setQuery($sql);
		return $this->executeQuery();
	}
	public function delRecentInsertBillDetail($idBill){
		$sql = "DELETE FROM bill_detail WHERE id_bill=$idBill";
		$this->setQuery($sql);
		return $this->executeQuery();
	}
}

?>