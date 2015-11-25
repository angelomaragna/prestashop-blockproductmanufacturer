{*
* This code is developed by Angelo Maragna and released
* under mit license (https://opensource.org/licenses/MIT)
*
*  @author NG Italy di Angelo Maragna <info@ngitaly.com>
*  @copyright  released under MIT license
*  @license  https://opensource.org/licenses/MIT
*
*}

	<!-- Block manufacturers module -->
	<div id="block_product_manufacturer" class="col-md-12">
		<h4 class="title_block">{l s='Manufacturer' mod='blockproductmanufacturer'}</h4>
		<div class="manufacturer_block" style="background-image: url('{$base_dir}/img/m/{$current_manufacturer_image}')">
			<div class="content-wrapper">
				<div class="title">{$current_manufacturer_name}</div>
				<div class="description">
					{$current_manufacturer_description}
				</div>
			</div>

		</div>

		<div class="block_content">
			<ul class="tree">
				{foreach from=$manufacturers item=manufacturer name=blockManufacturersTree}
					<li class="{if $smarty.foreach.blockManufacturersTree.first}isFirst{/if}{if $smarty.foreach.blockManufacturersTree.last}isLast{/if}">
						<a href="{$manufacturer['link']}">
							{$manufacturer['name']}
						</a>
					</li>

				{/foreach}
			</ul>
		</div>
	</div>
	<!-- /Block manufacturers module -->

