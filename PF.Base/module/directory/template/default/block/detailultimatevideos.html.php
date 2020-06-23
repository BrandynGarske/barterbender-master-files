<div id="yndirectory_business_detail_module_video" class="yndirectory_business_detail_module_video">	
	{module name='directory.filterinbusiness' 
		sPlaceholderKeyword=$sPlaceholderKeyword 

		ajax_action='directory.changeUltimateVideoListFilter'
		result_div_id='js_ynd_ultimate_video_list'
		custom_event='ondatachanged'
		is_prevent_submit='true'

		hidden_type='ultimatevideo'
		hidden_businessid=$aYnDirectoryDetail.aBusiness.business_id
		aYnDirectoryDetail=$aYnDirectoryDetail
		
		hidden_select=$hidden_select

	}	
	{if $bCanAddVideoInBusiness}
		<div id="yndirectory_menu_button">
			<a class="btn btn-primary btn-sm" href="{$sUrlAddVideo}" id="yndirectory_add_new_item">{phrase var='upload_share_a_video'}</a>
		</div>
		{literal}
			<script type="text/javascript">
				;$Behavior.init_yndirectory_business_detail_module_video = function(){
					yndirectory.addAjaxForCreateNewItem({/literal}{$aYnDirectoryDetail.aBusiness.business_id}{literal}, 'videos');		
				};
			</script>
		{/literal}
	{/if}

	<div id="js_ynd_ultimate_video_list">

		{module name='directory.detailultimatevideoslist'

			aYnDirectoryDetail=$aYnDirectoryDetail
		}
	</div>

</div>