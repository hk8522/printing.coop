<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Homes extends Public_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = ucfirst(strtolower($this->router->fetch_class())) . '/';
    }

    public function index()
    {
        $this->load->model('Printer_Model');
        $this->load->model('Product_Model');
        $this->load->model('Menu_Model');
        $this->load->model('Section_Model');
        $this->load->model('Banner_Model');
        $this->load->model('Service_Model');
        $this->load->model('Category_Model');
        $this->load->model('Page_Model');

        $this->data['page_title'] = 'Home';

        $Branrers = $this->Banner_Model->getHomePageBanners($this->website_store_id);
        $this->data['Branrers'] = $Branrers;

        $this->data['allServices'] = $this->Service_Model->getActiveServices($this->website_store_id);

        if ($this->website_store_id == 1) {
            $this->data['section_1'] = $this->Section_Model->getSectionById(1);
            $this->data['section_2'] = $this->Section_Model->getSectionById(2);
            $this->data['section_3'] = $this->Section_Model->getSectionById(3);
            $this->data['section_4'] = $this->Section_Model->getSectionById(4);
            $this->data['section_5'] = $this->Section_Model->getSectionById(5);
            $this->data['section_6'] = $this->Section_Model->getSectionById(6);
            $this->data['section_7'] = $this->Section_Model->getSectionById(7);

            $proudly_display_your_brand_tags = $this->Category_Model->getTasgList(1, 1);
            $montreal_book_printing_tags = $this->Category_Model->getTasgList(1, '', 1);
            $this->data['proudly_display_your_brand_tags'] = $proudly_display_your_brand_tags;
            $this->data['montreal_book_printing_tags'] = $montreal_book_printing_tags;
            $this->data['our_printed_products_category'] = $this->Category_Model->ourPrintedProductsCategory();

            $pageData = $this->Page_Model->getPageDataBySlug('home', $this->website_store_id);
            if (!empty($pageData)) {
                $this->data['page_title'] = $pageData['title'];
                $this->data['meta_page_title'] = $pageData['page_title'];
                $this->data['meta_description_content'] = $pageData['meta_description_content'];
                $this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
                if ($this->language_name == 'French') {
                    $this->data['page_title'] = $pageData['title_french'];
                    $this->data['meta_page_title'] = $pageData['page_title_french'];
                    $this->data['meta_description_content'] = $pageData['meta_description_content_french'];
                    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_french'];
                }

                $this->data['slug'] = $pageData['slug'];
                $this->data['pageData'] = $pageData;
            }
        } else if ($this->website_store_id == 3) {
            $this->data['section_1'] = $this->Section_Model->getSectionById(8);
            $this->data['section_2'] = $this->Section_Model->getSectionById(10);
            $this->data['section_3'] = $this->Section_Model->getSectionById(12);
            $this->data['section_4'] = $this->Section_Model->getSectionById(14);
            $this->data['section_5'] = $this->Section_Model->getSectionById(16);
            $this->data['section_6'] = $this->Section_Model->getSectionById(18);
            $this->data['section_7'] = $this->Section_Model->getSectionById(20);

            $proudly_display_your_brand_tags = $this->Category_Model->getTasgList(1, 1);
            $montreal_book_printing_tags = $this->Category_Model->getTasgList(1, '', 1);
            $this->data['proudly_display_your_brand_tags'] = $proudly_display_your_brand_tags;
            $this->data['montreal_book_printing_tags'] = $montreal_book_printing_tags;
            $this->data['our_printed_products_category'] = $this->Category_Model->ourPrintedProductsCategory();
        } else if ($this->website_store_id == 5) {
            $this->data['section_1'] = $this->Section_Model->getSectionById(9);
            $this->data['section_2'] = $this->Section_Model->getSectionById(11);
            $this->data['section_3'] = $this->Section_Model->getSectionById(13);
            $this->data['section_4'] = $this->Section_Model->getSectionById(15);
            $this->data['section_5'] = $this->Section_Model->getSectionById(17);
            $this->data['section_6'] = $this->Section_Model->getSectionById(19);
            $this->data['section_7'] = $this->Section_Model->getSectionById(21);
            $proudly_display_your_brand_tags = $this->Category_Model->getTasgList(1, 1, 0, 0, $this->main_store_id);
            $this->data['proudly_display_your_brand_tags'] = $proudly_display_your_brand_tags;
            $this->data['our_ink_printed_products'] = $this->Product_Model->getProductByTagId(11, 30);
            $this->data['PrinterBrandsLists'] = $this->Printer_Model->getActicePrinterBrandsList();

            //pr($this->data['our_ink_printed_products'],1);
        }

        $this->render($this->class_name . 'index');
    }

    public function COVIDMSGClose()
    {
        $this->load->helper('cookie');
        $cookie = array(
            'name' => 'COVID19MSG',
            'value' => 1,
            'expire' => 3600 * 24,
        );
        $this->input->set_cookie($cookie);
        exit();
    }
}
