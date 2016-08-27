<?php

/**
 * Description of ProductPresenter
 *
 * @author root
 */

namespace App\Presenters;

use App\Model\Product;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Nette\Caching\Cache;
use Nette;



class ProductPresenter extends BasePresenter
{
    /** temp cache directory */
    const CACHE_TEMP_DIR = '../temp/cache/';
    
    /** @var Caching\Cache */
    private $cacheRepository;
    
    /** @var App\Model\Product */
    public $product;
       
    public function __construct(Product $product) 
    {
        
        $this->product = $product;
        
        $this->cacheRepository = new Nette\Caching\Storages\FileStorage(self::CACHE_TEMP_DIR);
                
    }
    
    /** 
     * render default 
     */
    public function renderDetail($id)
    {
        $this->template->getJsonProduct = $this->switchData($id);
        
        $this->terminate();
    }
    
    /**
     * switch
     * load data from cache or MySQL
     * @param int $id
     * @return JSON data
     */
    private function switchData($id)
    {
        if(empty($id))
        {
            $this->flashMessage('musite zada ID knihy','success');
            $this->redirectUrl('Homepage:');
        }
        
        $cache = new Cache($this->cacheRepository);
        $value = $cache->load($id);
        
        if($value == NULL)
        {
            //load from MySQL
            $data = $this->product->getProduct($id);
            
            if($data == FALSE)
            {
                $this->flashMessage('bohuzel tato kniha se nenachazi v db','success');
                $this->redirectUrl('/');
            }
            
            $array = [
                        'idlibrary'=>$data->idlibrary,
                        'idlibrary_category'=>$data->idlibrary_category,
                        'name'=>$data->name,
                        'description'=>$data->description,
                        'text'=>$data->text
                    ];
                       
            //save to cache
            $cache->save($id, $array);
            
            //return data from MySQL and prepare JSON
            var_dump(['MySQL',$this->prepareJSON((array)$array)]);
            return $this->prepareJSON($array);
            
        }
        else
        {
            //load data from cache and prepare JSON
            var_dump(['cache',$this->prepareJSON((array)$value)]);
            return $this->prepareJSON($value);
        }
        
    }
    
    /**
     * prepare JSON data
     * @param array $data
     */
    private function prepareJSON($data)
    {
        try {
            
            return Json::encode($data);
            
        } catch (JsonException $ex) {
            
            Debugger::log($ex);
            
        }
    }
    
}
