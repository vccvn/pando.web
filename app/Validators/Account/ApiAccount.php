<?php

namespace App\Validators\Account;

use App\Repositories\Web\SettingRepository;

class ApiAccount extends BaseValidator
{
    public function extends()
    {
        $this->addRule('phone_exists', function($name, $value){
            if(!$value) return true;
            if($user = $this->repository->first(['phone_number'=>$value])){
                if($this->id){
                    if($this->id == $user->id){
                        return true;
                    }
                }
                return false;
            }
            return true;
        });

        
        $this->addRule('user_status', function($attr, $value){
            if(!$value) return true;
            if($status = get_user_config('status_list')){
                return isset($status[$value]);
            }
            return in_array($value, [-1, 0, 1]);
        });
        
        // $this->addRule('user_type', function($attr, $value){
        //     if($list = get_user_config('type_list')){
        //         return isset($list[$value]);
        //     }
            
        //     return in_array(strtolower($value), ['user', 'admin', 'mod', 'content', 'owner', 'staff']);
        // });

        $this->addRule('username', function($attr, $value){
            return preg_match('/^[A-z]+[A-z0-9_\.]*$/si', $value);
        });
 
        // $this->addRule('user_status', function($attr, $value){
        //     if(!$value) return true;
        //     if($status = get_user_config('status_list')){
        //         return isset($status[$value]);
        //     }
        //     return in_array($value, [-1, 0, 1]);
        // });

        $this->addRule('check_gender', function($attr, $value){
            if(!$value) return true;
            return in_array($value, ['male', 'female']);
        });


        $this->addRule('check_subdomain', function($attr, $value){
            $setting = New SettingRepository();
            if(!$this->base_domain || !in_array($this->base_domain, get_system_config('domain_list'))) return false;
            if($web = $setting->first(['subdomain'=>$value, 'base_domain'=>$this->base_domain])){
                if($this->id){
                    if($this->id == $web->owner_id) return true;
                }
                return false;
            }
            return true;
        });
        $this->addRule('check_alias', function($attr, $value){
            if(!$value) return true;
            $setting = New SettingRepository();
            // if(!$this->base_domain || !in_array($this->base_domain, get_system_config('domain_list'))) return false;
            if($web = $setting->first(['alias_domain'=>$value])){
                if($this->id){
                    if($this->id == $web->owner_id) return true;
                }
                return false;
            }
            return true;
        });
        $this->addRule('check_domain', function($attr, $value){
            if(!$this->base_domain || !in_array($this->base_domain, get_system_config('domain_list'))) return false;
            return true;
        });

        
        $this->addRule('check_web_type', function($attr, $value){
            if($list = get_system_config('web_type_list')){
                return isset($list[$value]);
            }
            
            return in_array(strtolower($value), ['user', 'admin', 'mod', 'content', 'owner', 'staff']);
        });
        $this->addRule('check_account_type', function($attr, $value){
            if($list = get_system_config('web_account_list')){
                return isset($list[$value]);
            }
            
            return in_array(strtolower($value), ['demo', 'pro', 'max']);
        });

        
        $this->addRule('check_secret_key', function($attr, $value){
            $secret_key = $this->request->header('vcc-secret', $this->secret_key);
            $client_key = $this->request->header('vcc-client', $this->client_key);
            // if(!$secret_key) $secret_key = $this->secret_key;
            // if(!$client_key) $client_key = $this->client_key;
            $args = compact('secret_key', 'client_key');
            if($secret_key && $client_key && $master = $this->repository->first($args)){
                $this->repository->controller->master = $master;
                return true;

            }
            return false;
        });

        $this->addRule('check_storage_limit', function($attr, $value){
            return (!$value || (is_numeric($value) && $value > 0));
        });


        
    }
    /**
     * ham lay rang buoc du lieu
     */
    public function rules()
    {
        // die(json_encode($this->request->all()));
        $id = $this->id;
        $password = $this->password;

        $rules = [
            'name'                => 'required|max:191',
            // 'gender'              => 'required|check_gender',
            // 'birthday'            => 'required|strdate',
            // 'address'             => 'mixed',
            'email'               => 'required|email|unique_prop',
            // 'phone_number'        => 'phone_number|phone_exists',
            'avatar'              => 'mimes:jpg,jpeg,png,gif',
            // thong tin tai khoan
            // 'username'            => 'required|username|unique_prop|min:4|max:64',

            // thông tin gói
            // 'type'                => 'user_type',
            'web_type'            => 'check_web_type',
            'account_type'        => 'check_account_type',
            'subdomain'           => 'required|check_subdomain',
            'alias_domain'        => 'check_alias',
            'base_domain'         => 'required|check_domain',
            'expired_at'          => 'mixed',
            // 'agree'               => 'required'
            'status'              => 'user_status',

            'secret'              => 'check_secret_key'
            
        ];

        if(!$id || strlen($this->password)){
            $rules['password'] = 'required|min:6';
        }
        if(!$id){
            $rules['storage_limited'] = 'check_storage_limit';
        }
        return $rules; //$this->parseRules($rules);
    }

    public function messages()
    {
        return [
            'name.max'                             => 'Họ tên dài vựa quá số ký tự',
            'name.required'                        => 'Bạn chưa nhập họ và tên',
            

            'username.required'                    => 'Bạn chưa nhập tên Đăng nhập',
            'username.min'                         => 'Tên người dùng phải có ít nhất 2 ký tự',
            'username.username'                    => 'Tên đăng nhập không hợp lệ',
            'username.unique_prop'                 => 'Tên đăng nhập đã tồn tại',
            
            'email.required'                       => 'Bạn chưa nhập email',
            'email.email'                          => 'Email không hợp lệ',
            'email.unique_prop'                    => 'Email đã tồn tại',
            
            'password.required'                    => 'Bạn chưa nhập mật khẩu',
            'password.min'                         => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed'                   => 'Mật khẩu không khớp',
            
            'phone_number.required'                => 'Số điện thoại không được bỏ trống',
            'phone_number.phone_number'            => 'Số điện thoại không hơp lệ',
            'phone_number.phone_exists'            => 'Số điện thoại Đã được sử dụng',
            '*.phone_number'                       => 'Số điện thoại không hơp lệ',

            'type.user_type'                       => 'Loại user không hợp lệ',
            
            'first_name.required'                  => 'Tên không được bỏ trống',
            
            'last_name.required'                   => 'Họ và đệm không được bỏ trống',
            
            'gender.required'                      => 'Giới tính không được bỏ trống',
            'gender.chevk_gender'                  => 'Giới tính không hợp lệ',
            
            'birthday.required'                    => 'Ngày sinh không được bỏ trống',
            'birthday.strdate'                     => 'Ngày sinh không hợp lệ',
            
            'address.max'                          => 'Địa chỉ không hợp lệ',
            
            'status.required'                      => 'Trạng thái không hợp lệ',
            'status.user_status'                   => 'Trạng thái không hợp lệ',
            

            'avatar.required'                      => 'Ảnh đại diện không được bỏ trống',
            'avatar.mimes'                         => 'Ảnh đại diện không đúng dịnh dạng',

            'web_type.required'                    => 'Bạn chưa chọn gói dịch vụ',
            'web_type.check_web_type'              => 'Gói dịch vụ không hợp lệ',
            'subdomain.required'                   => 'Bạn chưa nhập tên miền',
            'subdomain.check_subdomain'            => 'Tên miền này đã được sử dụng',
            'alias_domain.check_alias'             => 'Tên miền này đã được sử dụng',
            'agree'                                => 'Hãy chắc chắ rằng bạn đã dọc kỹ và đồng ý với các điều khoản của chúng tôi ',
            'storage_limited.*'                    => 'Dung luomh75 không hợp lệ',
        ];
    }
}