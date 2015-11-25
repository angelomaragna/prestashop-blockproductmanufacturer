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
	<div id="manufacturers_block_left" class="block">
		<h4 class="title_block">{l s='manufacturers' mod='blockmanufacturers'}</h4>
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

