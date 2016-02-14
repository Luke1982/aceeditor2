{**
 *
 * Copyright:
 *
 * MajorLabel - Guido Goluke
 * Web: www.majorlabel.nl
 * Email: info@majorlabel.nl
 *
 *
 * Authors:
 *
 * Guido Goluke, <info@majorlabel.nl>
 *  
 *
 * License:
 *-------------------------------------------------------------------------
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
 *
 * ------------------------------------------------------------------------
*}
<script>
$(window).load(function(){
	// Start out by filling out the input field with the currently selected width
	$('#AceWidthDisplay').attr('value',$('#AceWidthPcSlider').val()+'%');
	// Update the input field when slider changes
	$('#AceWidthPcSlider').change(function(){
		$('#AceWidthDisplay').attr('value',$('#AceWidthPcSlider').val()+'%');
	});
});
</script>
{form_start}
<div class="pageoverflow">
	<h3>{$mod->Lang('prefspage_title')}</h3>
	<p>{$mod->Lang('prefspage_intro')}</p>
</div>
<fieldset>
<div class="pageoverflow">
	<label for="editor_width_type">{$mod->Lang('width_pref_label')}</label><br />
	<p class="pageinput">
		<select name="{$actionid}editor_width_type">
			<option value="pc"{if $editor_width_type == 'pc'} selected{/if}>{$mod->Lang('width_pref_percent')}</option>
			<option value="px"{if $editor_width_type == 'px'} selected{/if}>{$mod->Lang('width_pref_pixels')}</option>
		</select>
	</p><br />
</div>
<div class="pageoverflow">
	<label for="editor_width_pc">{$mod->Lang('width_perc_label')}</label><br />
	<p class="pageinput">
		<input type="range" min="10" max="95" value="{$editor_width_pc}" step="5" name="{$actionid}editor_width_pc" id="AceWidthPcSlider"><br>
		<input type="text" size="5" id="AceWidthDisplay" value="" readonly>
	</p><br />
</div>
<div class="pageoverflow">
	<label for="editor_width_px">{$mod->Lang('width_pixels_label')}</label>
	<p class="pageinput">
		<input type="text" size="20" name="{$actionid}editor_width_px" value="{$editor_width_px}">
	</p><br />
</div>
<div class="pageoverflow">
	<label for="editor_height_px">{$mod->Lang('height_pixels_label')}</label><br />
	<p class="pageinput">
		<input type="text" size="20" name="{$actionid}editor_height_px" value="{$editor_height_px}">
	</p><br />
</div>
<div class="pageoverflow">
	<label for="editor_pref_fontsize">{$mod->Lang('pref_fontsize_label')}</label><br />
	<p class="pageinput">
		<input type="text" size="20" name="{$actionid}editor_pref_fontsize" value="{$editor_pref_fontsize}">
	</p>
</div>
</fieldset>
<fieldset>
	<label for="editor_css_prefmode">{$mod->Lang('css_prefmode_label')}</label><br />
	<p class="pageinput">
		<select name="{$actionid}editor_css_prefmode">
			<option value="css"{if $editor_css_prefmode == 'css'} selected{/if}>{$mod->Lang('cssmode_css')}</option>
			<option value="less"{if $editor_css_prefmode == 'less'} selected{/if}>{$mod->Lang('cssmode_less')}</option>
			<option value="sass"{if $editor_css_prefmode == 'sass'} selected{/if}>{$mod->Lang('cssmode_sass')}</option>
		</select>
	</p>
</fieldset>
<fieldset>
	<p class="pageinput">
		<h3>{$mod->Lang('ext_theme_fieldset_title')}</h3>
		<p>{$mod->Lang('ext_description')}</p>
		{assign 'selected_extensions' value=","|explode:$editor_extensions}
		{foreach $available_extensions as $extension}
			<input type="checkbox" name="{$actionid}editor_ext_checkbox_{$extension}" value="{$extension}" {if $extension|in_array:$selected_extensions}checked{/if}>{$extension}<br />
		{/foreach}
		<br />
		<p>{$mod->Lang('theme_description')}</p>
		<select name="{$actionid}editor_theme">
			<option value="twilight"{if $editor_theme == 'twilight'} selected{/if}>Twilight</option>
			<option value="dreamweaver"{if $editor_theme == 'dreamweaver'} selected{/if}>DreamWeaver</option>
			<option value="ambiance"{if $editor_theme == 'ambiance'} selected{/if}>Ambiance</option>
			<option value="chaos"{if $editor_theme == 'chaos'} selected{/if}>Chaos</option>
			<option value="chrome"{if $editor_theme == 'chrome'} selected{/if}>Chrome</option>
			<option value="clouds"{if $editor_theme == 'clouds'} selected{/if}>Clouds</option>
			<option value="clouds_midnight"{if $editor_theme == 'clouds_midnight'} selected{/if}>Clouds Midnight</option>
			<option value="cobalt"{if $editor_theme == 'cobalt'} selected{/if}>Cobalt</option>
			<option value="crimson_editor"{if $editor_theme == 'crimson_editor'} selected{/if}>Crimson Editor</option>
			<option value="dawn"{if $editor_theme == 'dawn'} selected{/if}>Dawn</option>
			<option value="eclipse"{if $editor_theme == 'eclipse'} selected{/if}>Eclipse</option>
			<option value="github"{if $editor_theme == 'github'} selected{/if}{if $editor_theme == 'dreamweaver'} selected{/if}>Github</option>
			<option value="idle_fingers"{if $editor_theme == 'idle_fingers'} selected{/if}>Idle Fingers</option>
			<option value="iplastic"{if $editor_theme == 'iplastic'} selected{/if}>iPlastic</option>
			<option value="terminal"{if $editor_theme == 'terminal'} selected{/if}>Terminal</option>
		</select>
	</p>
</fieldset>
<p class="pageinput">
	<input type="submit" name="{$actionid}submit" value="{$mod->Lang('save_prefs')}">
</p>
{form_end}