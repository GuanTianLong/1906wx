<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{

    /**
        *curl测试 form-data
     */
    public function curlPost1(){

        $user_info = [
            'user_name' => '小绿',
            'sex'       => '男',
            'age'       =>  '18',
        ];

        $url = "http://api.1906.com/test/post1";

        //初始化
        $ch = curl_init($url);

        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);

        //发送数据  form-data形式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$user_info);

        //执行会话
        $response = curl_exec($ch);

        var_dump($response);

        //捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno > 0){
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息：".$error;die;
        }

        //关闭会话
        curl_close($ch);


    }

    /**
        *curl测试 x-www-form-urlencoded
     */
    public function curlPost2(){
        //urlencoded格式
        $str = "name=小黄&sex=女&age=18";

        $url = "http://api.1906.com/test/post2";

        //初始化
        $ch = curl_init($url);

        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);

        //发送数据  x-www-form-urlencoded形式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);

        //执行会话
        $response = curl_exec($ch);

        var_dump($response);

        //捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno > 0){
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息：".$error;die;
        }

        //关闭会话
        curl_close($ch);
    }

    /**
        *curl测试 raw(json字符串)
     */
    public function curlPost3(){
        $user_info = [
            'user_name' => 'Jester',
            'sex'       => '男',
            'age'       =>  '20',
        ];

        $json = json_encode($user_info);

        $url = "http://api.1906.com/test/post3";

        //初始化
        $ch = curl_init($url);

        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);

        //发送数据  raw(json)形式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$json);

        //执行会话
        $response = curl_exec($ch);

        var_dump($response);

        //捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno > 0){
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息：".$error;die;
        }

        //关闭会话
        curl_close($ch);
    }

    /**
        *curl测试 访问接口上传文件
     */
    public function curlUpload(){
        $fiel_info = [
            'user_name' => '海绵宝宝',
            'age' => '19',
            'img' => new \CURLFile('hm.jpg')
        ];

        $url = "http://api.1906.com/test/testUpload";

        //echo $url;

        //初始化
        $ch = curl_init($url);

        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        //POST请求
        curl_setopt($ch,CURLOPT_POST,1);

        //发送数据  raw(json)形式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fiel_info);

        //执行会话
        $response = curl_exec($ch);

        //数据处理
        var_dump($response);

        //捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno > 0){
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息：".$error;die;
        }

        //关闭会话
        curl_close($ch);
    }

    /**
        *Guzzle(GET请求)
     */
    public function guzzleGet1(){
        $url = "http://api.1906.com/guzzle/guzzleGet1";
        $client = new Client();
        $response = $client->request('GET',$url,[
            'query' => [
                'name' => '张三',
                'sex'  => '男',
                'age'  => '20'
            ]
        ]);

        //获取服务端响应的数据
        $data = $response->getBody();

        echo $data;
    }

    /**
     *Guzzle(POST请求)
     */
    public function guzzlePost1(){
        $url = "http://api.1906.com/guzzle/guzzlePost1";
        $client = new Client();
        $response = $client->request('POST',$url,[
            'form_params' => [
                'name' => '爱丽丝',
                'sex'  => '女',
                'age'  => '19'
            ]
        ]);

        //获取服务端响应的数据
        $data = $response->getBody();

        echo $data;
    }

    /**
     *Guzzle上传文件(POST请求  必须使用form-data)
     */
    public function guzzleUpload(){
        $url = "http://api.1906.com/guzzle/guzzleUpload";
        $client = new Client();
        $response = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name' => 'user_name',
                    'contents'  => '萨摩耶'
                ],
                [
                    'name'          => 'Animal',
                    'contents'      => fopen('smy.jpg','r')
                ]
            ]
        ]);

        //获取服务端响应的数据
        $data = $response->getBody();

        echo $data;
    }

}
