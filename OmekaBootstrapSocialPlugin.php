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

class OmekaBootstrapSocialPlugin extends Omeka_Plugin_AbstractPlugin {
    
    protected $_hooks = array(
        //'config_form',
        'public_items_show',
        'public_footer'
        
    );
    
    public function setUp() {
        parent::setUp();
    }
    
    public function hookConfigForm() {
        // TODO: allow configuration of which plugins... split them out into diff functions instead of all in single appendToItems function
    }
    
    public function hookPublicItemsShow() {
        $item = get_current_record('item');
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
                     <a href="http://pinterest.com/pin/create/button/?url=<?php echo trim(record_url($item, 'show', true)) ?>&media=<?php echo trim($this->_getImageLink($item)); ?>&description=<?php metadata('item',array('Dublin Core','Title')) ?>" class="pin-it-button" count-layout="horizontal"><img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                </div>
                <div class="span2">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-href="<?php echo trim(record_url($item, 'show', true)) ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false" data-font="trebuchet ms"></div>
                </div>
                
            </div>
        <?php
    }
    
    public function hookPublicFooter() {
        ?>
        
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
        $aFiles = $item->getFiles();
        $fileURL = file_display_url($aFiles[0]);
        return $fileURL;
    }
    
}

?>
