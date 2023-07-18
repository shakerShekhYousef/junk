<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('user_informations', function(Blueprint $table)
		{
			$table->id();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->text('how_did_you_hear_about_junk')->nullable(true); // IG / FB / 
			$table->text('member_referral')->nullable(true);
			$table->text('influencer_referral')->nullable(true);
			$table->text('employee_referral')->nullable(true);
			$table->boolean('heart_condition')->nullable(true); // Yes /No
			$table->boolean('seizure_disorder')->nullable(true); // Yes /No
			$table->boolean('dizziness_or_fainting')->nullable(true); // Yes /No
			$table->boolean('hypertension')->nullable(true); // Yes /No
			$table->boolean('asthma')->nullable(true); // Yes /No
			$table->boolean('h_a_h_p_e_t_y_t_y_s_n_p_a')->nullable(true); // Yes /No	Has a healthcare provider ever told you that you should NOT perform physical activity?
			$table->boolean('d_y_h_l_t_c_p_y_f_p_a')->nullable(true); // Yes /No	Do you have limitations that can prevent you from physical activity?
			$table->boolean('d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a')->nullable(true); // Yes /No    Do you have muscle, tendon ligament, bine or joint problems that are exasperated by increased physical activity?
			$table->boolean('h_y_e_s_f_r_d')->nullable(true); // Yes /No	Have you ever suffered from respiratory difficulties?
			$table->boolean('h_y_e_s_f_f_m_o_l_o_b')->nullable(true); // Yes /No	Have you ever suffered from fainting, migraines or loss of balance?
			$table->boolean('d_y_e_f_a')->nullable(true); // Yes /No	Do you experience food allergies?
			$table->string('description')->nullable(true); // If you have answered yes to any of the above, please provide a brief explanation:
			$table->boolean('a_y_c_t_a_m')->nullable(true); // Yes /No	Are you currently taking any medications?
			$table->boolean('a_y_c_p')->nullable(true); // Yes /No	Are you currently pregnant?
			$table->boolean('confirm_data')->nullable(true); // Yes /No	I confirm that all the answers above are true to the best of my knowledge, and I believe I am able to participate in exercise at Junk Fitness Club
			
			// for crew only
			$table->string('h_d_y_h_a_u')->nullable(true); // How did you hear about us?
			$table->string('referral_name')->nullable(true);
			$table->string('w_i_y_m_g_p')->nullable(true); // What is your music genre preference? RAVE/ 90’s Classic/ Hip-Hop & R&B / Cheesy Pop 
			$table->string('w_i_y_p_f_g')->nullable(true); // If not listed, what is your personal favorite genre?
			$table->string('w_c_i_y_t_m_a_j')->nullable(true);  // What classes interest you the most at JUNK?  re-Cycle / Yoga/ re-Boot/ BeatBox 
			$table->string('w_c_w_y_l_t_s_j_o')->nullable(true); // what classes would you like to see JUNK offer?
			$table->boolean('d_y_c_e')->nullable(true);	//	Do you currently exercise?
			$table->string('w_a_y_c_d_f_e')->nullable(true);	// What are you currently doing for exercise?	
			$table->string('h_o_d_y_w_o_e_w')->nullable(true);	// How often do you work out each week? 	1-2X/week 	3-4X/week	5-6X/week 	7 + / week 
			$table->string('w_t_o_d_i_b_f_y_t_e_a_j_c')->nullable(true);	 // What time of day is best for you to enjoy a JUNK class?   Early AM / Mid- Morning – Early Pm/ Evening
			$table->string('w_d_a_b_f_y_t_b_y_j_c')->nullable(true);	// Which days are best for you to book your Junk classes?  Monday   / Tuesday /. Wednesday/. Thursday /. Friday/. Saturday/. Sunday
			$table->string('w_a_y_p_f_g')->nullable(true);	// What are your personal fitness goals?
			$table->string('w_c_h_y_e_r_y_f_g')->nullable(true);	// What challenges have you experienced reaching your fitness goals, if any?
			$table->boolean('h_y_e_u_p_g_t_i_t_p')->nullable(true);	// Have you ever used personal group training in the past?
			$table->string('h_w_y_e')->nullable(true);	// How was your experience?
			$table->string('staff_name')->nullable(true);

			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medical_informations');
	}

}
