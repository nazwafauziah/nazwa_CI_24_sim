<?php
class hello extends CI_controller {
    public function index()
{
    $data['nama'] = "";
    $this->load->view('hello_view', $data);
}
public function namasaya()
{
    $data['nama'] = "Codeigneter 3 + php 7.3";
    $this->load->view('hello_view', $data);
}

}