<?php
defined('PHPFOX') or exit('NO DICE!');
?>

<div class="ynsocialstore-module manage-photo">
    <div class="block">
        <form method="post" action="{url link='ynsocialstore.manage-photos'}?id={$iProductId}" class="collapse" id="js_ynsocialstore_form_upload_images" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{$iProductId}">
            <input type="hidden" name="type" value="ynsocialstore_product">
            <div id="js_ynsocialstore_form_holder">
                {module name='core.upload-form' type='ynsocialstore_product' params=$aParamsUpload}
                <div class="ynsocialstore-module cancel-upload">
                    <a href="{url link='ynsocialstore.manage-photos'}?id={$iProductId}" id="js_listing_done_upload" style="display: none;" class="text-uppercase"><i class="ico ico-check"></i>&nbsp;{_p var='finish_upload'}</a>
                </div>
            </div>
        </form>

        <div class="manage-photo-title">
            <span class="fw-bold"><span id="js_listing_total_photo">{$iTotalImage}</span> {_p var='photo_s'}</span>
            <a href="javascript:void(0)" id="js_listing_upload_photo" class="fw-bold" data-toggle="collapse" data-target="#js_ynsocialstore_form_upload_images">
                <i class="ico ico-upload-cloud"></i>&nbsp;{_p var='upload_new_photos'}
            </a>
        </div>

        {if count($aImages)}
        <form action="{url link='ynsocialstore.manage-photos'}?id={$iProductId}" method="POST">
            <div class="content item-container sortable">
                {foreach from=$aImages name=images item=aImage}
                <article title="{_p var='set_this_photo_as_main_photo_of_this_product'}"  id="js_photo_holder_{$aImage.image_id}" class="px-1 mb-2 js_mp_photo">
                    <div class="item-outer">
                        <input type="hidden" name="val[photo-order][{$aImage.image_id}]" class="js_mp_order" value="{$aImage.ordering}">
                        <div class="item-media">
                            <a onclick="$('.is-default').hide(); $(this).siblings('.is-default').show(); $.ajaxCall('ynsocialstore.setMainProductPhoto', 'iProductId={$iProductId}&iPhotoId={$aImage.image_id}&iOwnerId={$iOwnerId}'); return false;" href="javascript:void(0)" style="background-image: url({img server_id=$aImage.server_id path='core.url_pic' file=$aImage.image_path suffix='_400' max_width='120' max_height='120' class='js_mp_fix_width' return_url=true});"></a>
                            <span class="item-photo-delete" data-photo="{$aImage.image_id}" data-product="{$iProductId}" data-main="{if $sMainImage == $aImage.image_path}1{else}0{/if}" title="{_p var='delete_this_image_for_the_listing'}"><i class="ico ico-close"></i></span>
                            <div class="is-default" {if $sMainImage != $aImage.image_path}style="display:none"{/if}><div class="item-default"><i class="ico ico-photo-star-o"></i>{_p var='ynsocialstore_default_photo'}</div></div>
                        </div>
                    </div>
                </article>
                {/foreach}
            </div>
            <div>
                <button class="btn btn-primary" type="submit" name="val[order_photo]" id="btn_order" disabled>{_p var='Update Order'}</button>
            </div>
        </form>
        {else}
        <div class="alert alert-info">{_p var='no_photos_found'}</div>
        {/if}
    </div>
</div>

{literal}
<script type="text/javascript">
    $Behavior.updateOrderCoverPhoto = function () {
        $('.item-photo-delete').on('click', function () {
            var photo_id = $(this).data('photo');
            var product_id = $(this).data('product');
            var is_main = $(this).data('main');
            $Core.jsConfirm({}, function () {
                $.ajaxCall('ynsocialstore.deleteImage', $.param({id: photo_id, pId: product_id, is_main: is_main}));
            }, function () {
            });
            return false;
        });

        $('.sortable').sortable({
            opacity: 0.6,
            cursor: 'move',
            scrollSensitivity: 40,
            update: function (element, ui) {
                var iCnt = 0;
                $('.sortable .js_mp_order').each(function () {
                    iCnt++;
                    this.value = iCnt;
                });

                $('#btn_order').prop('disabled', false);
            }
        });
    };

    function onAfterDeletePhotoSuccess(photo_id) {
        var total_photo = $('.js_mp_photo').length;
        if (parseInt(total_photo) === 0) {
            window.location.reload();
        } else {
            $('#js_listing_total_photo').html(total_photo);
        }

        if (parseInt(photo_id) > 0) {
            var parent_ele = $('#js_photo_holder_' + photo_id);
            $('.item-photo-delete').data('main', 0);
            parent_ele.find('.is-default').show();
            parent_ele.find('.item-photo-delete').data('main', 1);
        }
    }
</script>
{/literal}
