<?php
class y_v_d{
  function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

  function isExisturl($url,$code)
    {

      if($code == 200 || $code == 302 || $code == 301)
        {
          return 1;
        }
        else {
          return 0;
        }
    }
  function getId($url)
    {
      $id = explode("?v=", $url);
      if (empty($id))
        {
            $id = explode("/v/", $url);
        }

      $id = explode("&", $id[1]);
      $id = $id[0];
      return $id;
    }
  function get_type($url)
    {

    $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

    $curl = curl_init($youtube);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return json_decode($return, true);

    }
  function getVideo($id)
    {
      parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $data);
      $stream = $data['url_encoded_fmt_stream_map'];
      $stream = explode(',',$stream);
      foreach ($stream as $row) {

       parse_str($row,$row1);

       foreach ($row1 as $key => $value)
        {
          $value = urldecode($value);
         if ($key != "url") {
              printf("<b>%s:</b> %s<br/>", $key, $value);

            }
        else {
              echo 'Download Your video:<a href='.$value.' download='.'downloadfilename'.'>'.'Download Video'.'</a><br/>';
          }
        }

        printf("<br/><br/>");
      }
    }

}

 ?>
