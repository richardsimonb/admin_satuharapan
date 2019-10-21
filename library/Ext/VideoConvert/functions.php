<?php
//error_reporting(0);
function php_path()
{
    if ( PHP_PATH != '' )
        return PHP_PATH;
    else
        return "/usr/bin/php";
}
function get_binaries( $path )
{
    $type = '';
    if ( is_array( $path ) )
    {
        $type = $path['type'];
        $path = $path['path'];
    }
    if ( $type == '' || $type == 'user' )
    {
        $path = strtolower( $path );
        switch ( $path )
        {
            case "php":
                return php_path();
                break;

            case "mp4box":
                return '/usr/bin/MP4Box';
                break;

            case "flvtool2":
                return '/usr/bin/flvtool2';
                break;

            case "ffmpeg":
                return '/usr/bin/ffmpeg';
                break;
        }
    } else
    {
        $path = strtolower( $path );
        switch ( $path )
        {
            case "php":
                $return_path = shell_output( "which php" );
                if ( $return_path )
                    return $return_path;
                else
                    return "Unable to find PHP path";
                break;

            case "mp4box":
                $return_path = shell_output( "which MP4Box" );
                if ( $return_path )
                    return $return_path;
                else
                    return "Unable to find mp4box path";
                break;

            case "flvtool2":
                $return_path = shell_output( "which flvtool2" );
                if ( $return_path )
                    return $return_path;
                else
                    return "Unable to find flvtool2 path";
                break;

            case "ffmpeg":
                $return_path = shell_output( "which ffmpeg" );
                if ( $return_path )
                    return $return_path;
                else
                    return "Unable to find ffmpeg path";
                break;
        }
    }
}
function shell_output( $cmd )
{
    if ( stristr( PHP_OS, 'WIN' ) )
    {
        $cmd = $cmd;
    } else
    {
        $cmd = "PATH=\$PATH:/bin:/usr/bin:/usr/local/bin bash -c \"$cmd\"  2>&1";
    }
    $data = shell_exec( $cmd );
    return $data;
}
function GetName( $file )
{
    if ( !is_string( $file ) )
        return false;
    $path = explode( '/', $file );
    if ( is_array( $path ) )
        $file = $path[count( $path ) - 1];
    $new_name = substr( $file, 0, strrpos( $file, '.' ) );
    return $new_name;
}
function parse_version( $path, $result )
{
    switch ( $path )
    {
        case 'ffmpeg':
            {
                //Gett FFMPEG SVN version
                preg_match( "/svn-r([0-9]+)/i", strtolower( $result ), $matches );

                //	if(is_numeric(floatval($matches[1])) && $matches[1]) {
                //		return 'Svn '.$matches[1];
                //	}
                //Get FFMPEG version
                preg_match( "/FFmpeg version ([0-9.]+),/i", strtolower( $result ),
                    $matches );
                if ( is_numeric( floatval( $matches[1] ) ) && $matches[1] )
                {
                    return $matches[1];
                }

                //Get FFMPEG GIT version
                preg_match( "/ffmpeg version n\-([0-9]+)/i", strtolower( $result ),
                    $matches );

                if ( is_numeric( floatval( $matches[1] ) ) && $matches[1] )
                {
                    return 'Git '.$matches[1];
                }
            }
            break;
        case 'php':
            {
                return phpversion();
            }
            break;
        case 'flvtool2':
            {
                preg_match( "/flvtool2 ([0-9\.]+)/i", $result, $matches );
                if ( is_numeric( floatval( $matches[1] ) ) )
                {
                    return $matches[1];
                } else
                {
                    return false;
                }
            }
            break;
        case 'mp4box':
            {
                preg_match( "/version (.*) \(/Ui", $result, $matches );
                //pr($matches);
                if ( is_numeric( floatval( $matches[1] ) ) )
                {
                    return $matches[1];
                } else
                {
                    return false;
                }
            }
    }
}
function RandomString( $length )
{
    $string = md5( microtime() );
    $highest_startpoint = 32 - $length;
    $randomString = substr( $string, rand( 0, $highest_startpoint ), $length );
    return $randomString;

}

function unhtmlentities( $string )
{
    $trans_tbl = get_html_translation_table( HTML_ENTITIES );
    $trans_tbl = array_flip( $trans_tbl );
    return strtr( $string, $trans_tbl );
}
function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName;
}
?>