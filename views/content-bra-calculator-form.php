<?php
/**
 * Created by JM Designs
 * Name: Jared Mitchell
 * Website : http://www.jmdesigns.co.nz
 * Time/Date: 8:14 PM 21/08/17
 * Filename: bra-calculator-form.php
 */

?>

<div class="bc-container">
	
	<h2>Sizing Help</h2>
	<div class="bc-row">
		<div class="bc-col-mid">
			<p>To send our team your measurements and get help with bra sizing, please click below and fill our sizing form. We will then reach out via email. Also please feel free to use the calculator and table below.</p>
			<p style="margin-top:15px; margin-bottom: 20px;"><a href="#bc-sizing-help" class="popup-bc-calculator" style="cursor: pointer;"><span>Click Here for Sizing Form</span></a></p>
		</div>
	</div>

	<h2>Bra Size Calculator</h2>

	<p class="bc-italics">Please enter the following measurements</p>

	<div class="bc-row">

		<div class="bc-col-1">
			<p>Band: Place your measuring tape at the center of your chest above your bust and run it around your back under your arms, returning to your chest.</p>
		</div>
		<div class="bc-col-2">
			<label for="band_size"></label>
			<input type="text" name="band_size" id="band_size" value="" placeholder="Size in Inches" style="text-align:center !important;">

			<p class="error">Please enter a size between 30 and 50</p>
		</div>

		<div class="bc-col-1">

			<p>Bust: with a bra on, place your measuring tape at the fullest point of your bust, then run it around your back under your arms, returning to that
				point.</p>

		</div>
		<div class="bc-col-2">
			<label for="bust_size"></label>
			<input type="text" name="bust_size" id="bust_size" value="" placeholder="Size in Inches" style="text-align:center !important;">

			<p class="error">Please enter size number between 30 and 50</p>
		</div>
		<div class="bc-col-result"><p class="result-text">Your calculated Bra size is: <span class="bc-result"></span></p></div>

	</div>


	<h2>Bottom Sizing Table</h2>

	<p class="bc-italics">Please refer to the conversion table below for shapewear and panty sizing</p>

	<table class="sizing-table">
		<thead>
		<tr>
			<th colspan="3">BOTTOM SIZING</th>
		</tr>
		<tr>
			<th>SIZE</th>
			<th>WAIST</th>
			<th>HIPS</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>S</td>
			<td>25-26"</td>
			<td>35-36"</td>
		</tr>
		<tr>
			<td>M</td>
			<td>27-28"</td>
			<td>37-38"</td>
		</tr>
		<tr>
			<td>L</td>
			<td>29-30"</td>
			<td>39-40"</td>
		</tr>
		<tr>
			<td>XL</td>
			<td>31-32"</td>
			<td>41-42"</td>
		</tr>
		<tr>
			<td>2XL</td>
			<td>33-34"</td>
			<td>43-44"</td>
		</tr>
		<tr>
			<td>3XL</td>
			<td>35-36"</td>
			<td>45-46"</td>
		</tr>
		<tr>
			<td>4XL</td>
			<td>37-38"</td>
			<td>47-48"</td>
		</tr>
		</tbody>
	</table>

</div>

