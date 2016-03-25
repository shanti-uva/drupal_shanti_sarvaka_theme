# Shanti Sarvaka Theme

The base theme for SHANTI's Digital Ecology of apps 

A Bootstrap-based Drupal theme for all of Shanti's restyling from Convoy.

Based on Bootstrap v3.x

Development Begun: May 2014

* **Lead:** Than Grove
* **Developers:** Gerard Ketuma, Mark Ferrara

# Requirements
* jQuery Update (jquery v. 1.10.2) is required for the functioning of the Bootstrap interface.
* Custom Sarvaka Modules: https://github.com/shanti-uva/drupal_shanti_sarvaka_modules

# Notes

* Explore menu button and preference menu are part of Shanti Sarvaka modules which must be enabled
* Options can be added to search form by modules using hook_form_alter on 'search_block_form' and adding a 'shanti_options' element to the form array
_Example is:_
```
$form['shanti_options'] = array(
			'scope' => array(
				'#type' => 'checkboxes',
				'#options' => array(t('Descriptions'), t('Transcripts')),
				'#attributes' => array('class' => array('shanti-options')),
			),
		);
```
* A JS function is included to format all numbers with class .ssfmtnum to insert commas
