<?php

/*
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Description of OmekaBootstrapSocial
 *
 * @author Garrick S. Bodine <garrick.bodine@gmail.com>
 */

class OmekaBootstrapSocial extends Omeka_Plugin_AbstractPlugin {
    
    protected $_hooks = array(
        'config_form',
        'public_append_to_items_show',
        'public_theme_footer'
        
    );
    
    public function hookConfigForm() {
        // TODO: allow configuration of which plugins... split them out into diff functions instead of all in single appendToItems function
    }
    
    public function hookPublicAppendToItemsShow() {
        $item = get_current_item();
        ?>
        <div class="row">
                <div class="span6">
                    <hr />
                     <h4><i class="icon-thumbs-up icon-large"></i> Share!</h4>
                </div>
            </div>
            <div class="row">
                <div class="span1">
                   <a href="https://twitter.com/share" class="twitter-share-button" data-via="BerryArchive"></a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="span1">
                    <g:plus action="share" annotation="bubble"></g:plus>
                    <script type="text/javascript">
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                </div>
                <div class="span1">
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="trebuchet ms"></div>
                </div>
                <div class="span1">
                     <a href="http://pinterest.com/pin/create/button/?url=<?php echo trim(abs_item_uri()) ?>&media=<?php echo trim($this->_getImageLink(get_current_item())); ?>&description=<?php item('Dublin Core','Description') ?>" class="pin-it-button" count-layout="horizontal"><img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                </div>
            </div>
        <?php
    }
    
    public function hookPublicThemeFooter() {
        ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
        
        <?php 
    }
    
    private function _getImageLink($item) {
        $fileNum = 0;
        while(loop_files_for_item($item)) { 
            $file = get_current_file();
            if ($fileNum == 0) {
                $fileURL =  file_display_uri($file);
            }
            $fileNum++;
        }
        return $fileURL;
    }
    
}

?>
