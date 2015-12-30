<?php 

namespace Vis\Builder\Fields;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;


class ImageField extends AbstractField 
{

    public function isEditable()
    {
        return true;
    } // end isEditable

    public function getListValue($row)
    {
        if ($this->hasCustomHandlerMethod('onGetListValue')) {
            $res = $this->handler->onGetListValue($this, $row);
            if ($res) {
                return $res;
            }
        }
        
        if ($this->getAttribute('is_multiple')) {
            return $this->getListMultiple($row);
        }
        
        return $this->getListSingle($row);
    } // end getListValue
    
    private function getListSingle($row)
    {
        $pathPhoto = $this->getValue($row);;
        if (!$pathPhoto) {
            return '';
        }

        $html = '<img src="' . glide($pathPhoto, ['w' => '50']) . '" />';

        return $html;
    } // end getListSingle    
    
    private function getListMultiple($row)
    {
        if (!$this->getValue($row)) {
            return '';
        }
        
        $images = json_decode($this->getValue($row), true);
        
        // FIXME: fix fixfix
        $html = '<div style="cursor:pointer;height: 50px;overflow: hidden;" onclick="$(this).css(\'height\', \'auto\').css(\'overflow\', \'auto\');">';
        foreach ($images as $source) {
            $src = $this->getAttribute('before_link')
                  . $source['sizes']['original']
                  . $this->getAttribute('after_link');
                  
            // FIXME: move to template
            $src = $this->getAttribute('is_remote') ? $src : URL::asset($src);
            $html .= '<img height="'. $this->getAttribute('img_height', '50px') .'" src="'
                  . $src
                  . '" /><br>';
        }

        $html .= '</div>';

        return $html;
    } // end getListMultiple

    public function onSearchFilter(&$db, $value)
    {
        $db->where($this->getFieldName(), 'LIKE', '%'.$value.'%');
    } // end onSearchFilter
    
    public function getEditInput($row = array())
    {

        if ($this->hasCustomHandlerMethod('onGetEditInput')) {
            $res = $this->handler->onGetEditInput($this, $row);
            if ($res) {
                return $res;
            }
        }

        // TODO: review
        // FIXME: separate templates
        $input = View::make('admin::tb.input_image_upload');
        $input->value   = $this->getValue($row);
        $input->source  = json_decode($this->getValue($row), true);
        $input->name    = $this->getFieldName();
        $input->caption = $this->getAttribute('caption');
        $input->is_multiple = $this->getAttribute('is_multiple');
        $input->delimiter   = $this->getAttribute('delimiter');
        $input->width   = $this->getAttribute('img_width') ? $this->getAttribute('img_width') : 200;
        $input->height   = $this->getAttribute('img_height') ? $this->getAttribute('img_height') : 200;


        return $input->render();
    } // end getEditInput
    
    public function doUpload($file)
    {
        $this->checkSizeFile($file);

        $extension = $file->guessExtension();
        $rawFileName = md5_file($file->getRealPath()) .'_'. time();
        $fileName = $rawFileName .'.'. $extension;
        
        $definitionName = $this->getOption('def_name');
        $prefixPath = 'storage/tb-'.$definitionName.'/';
        // FIXME: generate path by hash
        $postfixPath = date('Y') .'/'. date('m') .'/'. date('d') .'/';
        $destinationPath = $prefixPath . $postfixPath;
        
        $status = $file->move($destinationPath, $fileName);
        
        $data = array();
        $data['sizes']['original'] = $destinationPath . $fileName;
        
        $variations = $this->getAttribute('variations', array());
        foreach ($variations as $type => $methods) {
            $img = Image::make($data['sizes']['original']);
            foreach ($methods as $method => $args) {
                call_user_func_array(array($img, $method), $args);
            }
            
            $path = $destinationPath . $rawFileName .'_'. $type .'.'. $extension;
            $quality = $this->getAttribute('quality', 100);
            $img->save(public_path() .'/'. $path, $quality);
            $data['sizes'][$type] = $path;
        }

        $width   = $this->getAttribute('img_width') ? $this->getAttribute('img_width') : 200;
        $height   = $this->getAttribute('img_height') ? $this->getAttribute('img_height') : 200;
        
        $response = array(
            'data'       => $data,
            'status'     => $status,
            'link'       => glide($destinationPath . $fileName, ['w' => $width, 'h' => $height]),
            'short_link' => $destinationPath . $fileName,
            // FIXME: naughty hack
            'delimiter' => ','
        );
        return $response;
    } // end doUpload

    private function checkSizeFile($file)
    {
        if ($this->getAttribute('limit_mb')) {
            $limit_mb = $this->getAttribute('limit_mb')*1000000;
            if ($file->getSize() > $limit_mb) {
                App::abort(500, "Ошибка загрузки файла. Файл больше чем ".$this->getAttribute('limit_mb')." МБ");
            }
        }
    }
    
    public function prepareQueryValue($value)
    {
        $vals = json_decode($value, true);
        if ($vals && $this->getAttribute('is_multiple')) {
            foreach ($vals as $key => $image) {
                if (isset($image['remove']) && $image['remove']) {
                    unset($vals[$key]);
                }
            }
            // HACK: cuz we have object instead of array
            $value = json_encode(array_values($vals));
        } elseif ($vals) {
            if (isset($vals['remove']) && $vals['remove']) {
                $value = '';
            }
        }
        
        return $value;
    } // end prepareQueryValue

}
