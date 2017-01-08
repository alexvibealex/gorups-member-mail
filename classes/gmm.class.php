<?php

if(!class_exists('Group_Members_Mail'))
{   
    if ( bp_is_active( 'groups' ) ) :
        class Group_Members_Mail extends BP_Group_Extension {

            function __construct() {
                $args = array(
                    'slug' => 'group-members-mail',
                    'name' =>  __('E-Mail Members','bp-gmm'),
                    'enable_nav_item' => false,
                    'nav_item_position' => 105,
                    'access' => apply_filters('bp_gmm_auhority','mod'),
                    'screens' => array(
                        'edit' => array(
                            'name' => __('E-Mail Members','bp-gmm'),
                            // Changes the text of the Submit button
                            // on the Edit page
                            'submit_text' => __('Send','bp-gmm'),
                        ),
                    ),
                );
                parent::init( $args );
            }
         
            
         
            function settings_screen( $group_id = NULL ) {
                $setting = groups_get_groupmeta( $group_id, 'group_member_mail_setting' );
                $setting2 = groups_get_groupmeta( $group_id, 'group_member_mail_setting_subject' );
         
                ?>
                Send email to your group members here :  
                <label for="group_member_mail_setting_subject"><?php echo __('Subject','bp-gmm');?></label>
                <input type="text" id="group_member_mail_setting_subject" name="group_member_mail_setting_subject" value="<?php echo stripslashes($setting2 ); ?>">
                <label for="group_member_mail_setting"><?php echo __('Message','bp-gmm'); ?></label>
                <?php wp_editor(stripslashes($setting ),'group_member_mail_setting',array( 'media_buttons' => false ));?>

                <?php
            }
         
            function settings_screen_save( $group_id = NULL ) {
                add_filter( 'wp_mail_content_type', 'set_content_type' );
                $setting = isset( $_POST['group_member_mail_setting'] ) ? $_POST['group_member_mail_setting'] : '';
                $setting2 = isset( $_POST['group_member_mail_setting_subject'] ) ? $_POST['group_member_mail_setting_subject'] : '';
                $name = get_bloginfo('name');
                $email = get_bloginfo('admin_email');
                $members=array();
                if ( bp_group_has_members( 'group_id='.$group_id.'&per_page=999&exclude_admins_mods=true' ) ){ 
                    while ( bp_group_members() ) : bp_group_the_member(); 
                        $members[]=bp_get_group_member_id();
                        endwhile;
                }
                $to=array();
                foreach ($members as $member) {
                    $user=get_user_by('id',$member);
                   $to[]=$user->user_email;
                }
                $group = new BP_Groups_Group($group_id, true);
                if(isset( $setting2)){
                   $subject=$setting2; 
                }else{
                    $subject= __('Notice from ','bp-gmm').$group->name ;
                }
                    
                if(!empty($to) && is_array($to))
                $bool= wp_mail($to, $subject, stripslashes($setting ));
                if( $bool){
                    groups_update_groupmeta( $group_id, 'group_member_mail_setting', $setting );
                    groups_update_groupmeta( $group_id, 'group_member_mail_setting_subject', $setting2 );
                }
            }

           
         
        }
        bp_register_group_extension( 'Group_Members_Mail' );
     
    endif; 
}