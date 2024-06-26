<?php

namespace App\Engines;

use Crazy\Helpers\Arr;

/**
 * @method Breadcrumb append(string $text = null, string $url = null) thêm một nút vào cuối danh sách
 * @method Breadcrumb prepend(string $text = null, string $url = null) thêm một nút vào dầu danh sách
 * @method Breadcrumb remove(int $index = null) xóa một mắt xích hoặc tất cả
 * @method Breadcrumb add(string $text = null, string $url = null) thêm một nút
 * @method Breadcrumb addPost(\App\Models\Post|\App\Mask\Posts\PostMask $post) Thêm một bài viết
 * @method Breadcrumb addPage(\App\Models\Page|\App\Mask\Pages\PageMask $page) Thêm một trang
 * @method Breadcrumb addProject(\App\Models\Project|\App\Mask\Projectts\ProjectMask $project) Thêm một dự án
 * @method Breadcrumb addProduct(\App\Models\Product|\App\Mask\Products\ProductMask $product) Thêm một Sản phẩm
 * @method Breadcrumb addCategory(\App\Models\Category|\App\Mask\Categories\CategoryMask $category) Thêm một Danh mục
 * @method Breadcrumb addDynamic(\App\Models\Dynamic|\App\Mask\Dynamics\DynamicMask $dynamic) thêm dynamic vào Breadcrumb
 * @method Breadcrumb set(string $text = null, string $url = null) thêm một nút
 * @method Breadcrumb setPost(\App\Models\Post|\App\Mask\Posts\PostMask $post) Thêm một bài viết
 * @method Breadcrumb setPage(\App\Models\Page|\App\Mask\Pages\PageMask $page) Thêm một trang
 * @method Breadcrumb setProject(\App\Models\Project|\App\Mask\Projectts\ProjectMask $project) Thêm một dự án
 * @method Breadcrumb setProduct(\App\Models\Product|\App\Mask\Products\ProductMask $product) Thêm một Sản phẩm
 * @method Breadcrumb setCategory(\App\Models\Category|\App\Mask\Categories\CategoryMask $category) Thêm một Danh mục
 * @method Breadcrumb setDynamic(\App\Models\Dynamic|\App\Mask\Dynamics\DynamicMask $dynamic) thêm dynamic vào Breadcrumb
 * @method string getFulltitle() lấy về title được set
 * @method array|Arr[] getMAp() lấy vè mảng breakcrump
 * 
 * @method static Breadcrumb append(string $text = null, string $url = null) thêm một nút vào cuối danh sách
 * @method static Breadcrumb prepend(string $text = null, string $url = null) thêm một nút vào dầu danh sách
 * @method static Breadcrumb remove(int $index = null) xóa một mắt xích hoặc tất cả
 * @method static Breadcrumb add(string $text = null, string $url = null) thêm một nút
 * @method static Breadcrumb addPost(\App\Models\Post|\App\Mask\Posts\PostMask $post) Thêm một bài viết
 * @method static Breadcrumb addPage(\App\Models\Page|\App\Mask\Pages\PageMask $page) Thêm một trang
 * @method static Breadcrumb addProject(\App\Models\Project|\App\Mask\Projectts\ProjectMask $project) Thêm một dự án
 * @method static Breadcrumb addProduct(\App\Models\Product|\App\Mask\Products\ProductMask $product) Thêm một Sản phẩm
 * @method static Breadcrumb addCategory(\App\Models\Category|\App\Mask\Categories\CategoryMask $category) Thêm một Danh mục
 * @method static Breadcrumb addDynamic(\App\Models\Dynamic|\App\Mask\Dynamics\DynamicMask $dynamic) thêm dynamic vào Breadcrumb
 * @method static Breadcrumb set(string $text = null, string $url = null) thêm một nút
 * @method static Breadcrumb setPost(\App\Models\Post|\App\Mask\Posts\PostMask $post) Thêm một bài viết
 * @method static Breadcrumb setPage(\App\Models\Page|\App\Mask\Pages\PageMask $page) Thêm một trang
 * @method static Breadcrumb setProject(\App\Models\Project|\App\Mask\Projectts\ProjectMask $project) Thêm một dự án
 * @method static Breadcrumb setProduct(\App\Models\Product|\App\Mask\Products\ProductMask $product) Thêm một Sản phẩm
 * @method static Breadcrumb setCategory(\App\Models\Category|\App\Mask\Categories\CategoryMask $category) Thêm một Danh mục
 * @method static Breadcrumb setDynamic(\App\Models\Dynamic|\App\Mask\Dynamics\DynamicMask $dynamic) thêm dynamic vào Breadcrumb
 * @method static string getFulltitle() lấy về title được set
 * @method static array|Arr[] getMAp() lấy vè mảng breakcrump
 * 
 * 
 */
class Breadcrumb
{
    public static $data = [];
    /**
     * thêm đối tượng Breadcrumb
     *
     * @param string $text
     * @param mixed $url
     * @return bool
     */
    protected function _add($text = null, $url = null)
    {
        $type = $url ? 'url' : 'text';
        static::$data[] = new Arr(compact('type', 'text', 'url'));
        return $this;
    }

    /**
     * thêm đối tượng Breadcrumb
     *
     * @param string $text
     * @param mixed $url
     * @return bool
     */
    protected function _append($text = null, $url = null)
    {
        $type = $url ? 'url' : 'text';
        static::$data[] = new Arr(compact('type', 'text', 'url'));
        return $this;
    }

    /**
     * thêm vào đầu danh sách
     *
     * @param string $text
     * @param mixed $url
     * @return bool
     */
    protected function _prepend($text = null, $url = null)
    {
        $type = $url ? 'url' : 'text';
        array_unshift(static::$data, new Arr(compact('type', 'text', 'url')));
        return $this;
    }

    protected function _remove($index = null)
    {
        if (is_null($index)) {
            static::$data = [];
            return $this;
        } elseif (is_numeric($index) && isset(static::$data[$index])) {
            array_slice(static::$data, $index, 1);
            return $this;
        }
        return $this;
    }

    /**
     * thêm post vào Breadcrumb
     *
     * @param \App\Models\Post|\App\Masks\Posts\PostMask $post
     * @return void
     */
    protected function _addpost($post)
    {
        if ($post->category_id) {
            if ($category = get_model_data('post_category', $post->category_id)) {
                $tree = $category->getTree();

                foreach ($tree as $cate) {
                    $this->_prepend($cate->name, $cate->getViewUrl());
                }
            }
        }
        if ($dynamic = get_model_data('dynamic', $post->dynamic_id)) {
            $this->_prepend($dynamic->name, $dynamic->getViewUrl());
        }
        $this->_append($post->title, $post->getViewUrl());
        return $this;
    }

    /**
     * thêm page vào Breadcrumb
     *
     * @param \App\Models\Page|\App\Masks\Pages\PageMask $page
     * @return void
     */
    protected function _addpage($page)
    {
        $tree = $page->getTree();
        if ($tree && is_callable($tree) && count($tree)) {
            foreach ($tree as $cate) {
                $this->_append($cate->title, $cate->getViewUrl());
            }
        }
        return $this;
    }


    /**
     * thêm dynamic vào Breadcrumb
     *
     * @param \App\Models\Dynamic|\App\Masks\Dynamics\DynamicMask $dynamic
     * @return void
     */
    protected function _adddynamic($dynamic)
    {
        $this->_append($dynamic->name, $dynamic->getViewUrl());
        return $this;
    }



    /**
     * thêm project vào Breadcrumb
     *
     * @param \App\Models\Project|\App\Masks\Projects\ProjectMask $project
     * @return void
     */
    protected function _addproject($project)
    {
        if ($project->category_id) {
            if ($category = get_model_data('project_category', $project->category_id)) {
                $tree = $category->getTree();

                foreach ($tree as $cate) {
                    $this->_append($cate->name, $cate->getViewUrl());
                }
            }
        }
        $this->_prepend('dự án', route('client.projects'));
        $this->_append($project->title, $project->getViewUrl());
        return $this;
    }
    /**
     * thêm Product vào Breadcrumb
     *
     * @param \App\Models\Product|\App\Masks\Products\ProductMask $product
     * @return void
     */
    protected function _addproduct($product)
    {
        if ($product->category_id) {
            if ($category = get_model_data('product_category', $product->category_id)) {
                $tree = $category->getTree();

                foreach ($tree as $cate) {
                    $this->_append($cate->name, $cate->getViewUrl());
                }
            }
        }

        $this->_prepend('Sản Phẩm', route('client.products'));
        $this->_append($product->name, $product->getViewUrl());
        return $this;
    }

    /**
     * thêm danh mục
     *
     * @param \App\Models\Category|\App\Masks\Categories\CategoryMask $category
     * @return void
     */
    protected function _addcategory($category)
    {
        $tree = $category->getTree();
        foreach ($tree as $cate) {
            $this->_append($cate->name, $cate->getViewUrl());
        }
        if ($category->type == 'post') {
            if ($dynamic = get_model_data('dynamic', $category->dynamic_id)) {
                $this->_prepend($dynamic->name, $dynamic->getViewUrl());
            }
        } elseif ($category->type == 'product') {
            $this->_prepend('Sản Phẩm', route('client.products'));
        } elseif ($category->type == 'project') {
            $this->_prepend('Dự án', route('client.projects'));
        }
        return $this;
    }

    /**
     * lấy tiru6 đề theo
     *
     * @return void
     */
    protected function _getfulltitle()
    {
        $title = [];
        foreach (static::$data as $key => $item) {
            array_unshift($title, $item->text);
        }
        if ($title) {
            $title[] =  siteinfo('site_name');
            return implode(' | ', $title);
        }
        return null;
    }


    /**
     * lấy về bản đồ
     *
     * @return void
     */
    protected function _getmap()
    {
        $a = static::$data;
        array_unshift($a, new Arr(['type' => 'url', 'text' => 'Trang chủ', 'url' => route('home')]));
        return $a;
    }




    public static function __callStatic($name, $arguments)
    {
        $obj = new static();
        return call_user_func_array([$obj, $name], $arguments);
    }


    public function __call($name, $arguments)
    {
        $func = strtolower($name);
        $f = substr($func, 0, 3);
        $item = substr($func, 3);
        if($f == 'set') $f = 'add';
        $fn = '_'.$f.$item;
        if(method_exists($this, $fn)){
            return call_user_func_array([$this, $fn], $arguments);
        }

        return null;
    }
}
