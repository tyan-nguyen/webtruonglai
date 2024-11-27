<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $site_name
 * @property string|null $site_logo
 * @property string|null $site_logo_small
 * @property string $site_copyright
 * @property string|null $site_source
 * @property string|null $top_text
 * @property string|null $top_email
 * @property string|null $top_hotline
 * @property string|null $site_copyright_en
 * @property string|null $site_source_en
 * @property string|null $top_text_en
 * @property string $text_homepage
 * @property string|null $map
 * @property string|null $showcase_text
 * @property string|null $showcase_text_en
 * @property string|null $showcase_title
 * @property string|null $showcase_title_en
 * @property string|null $showcase_summary
 * @property string|null $showcase_summary_en
 * @property string|null $branches_text
 * @property string|null $branches_text_en
 * @property string|null $branches_title
 * @property string|null $branches_title_en
 * @property string|null $branches_summary
 * @property string|null $branches_summary_en
 * @property string|null $branches_page_name
 * @property string|null $branches_page_name_en
 * @property string|null $branches_page_seo_title
 * @property string|null $branches_page_seo_description
 * @property string|null $branches_fist_content
 * @property string|null $branches_fist_content_en
 * @property string|null $branches_fist_image
 * @property int|null $branches_show_default
 * @property string|null $service_text
 * @property string|null $service_text_en
 * @property string|null $service_title
 * @property string|null $service_title_en
 * @property string|null $service_summary
 * @property string|null $service_summary_en
 * @property string|null $service_image
 * @property int|null $show_service_image
 * @property string|null $about_text
 * @property string|null $about_text_en
 * @property string|null $about_title
 * @property string|null $about_title_en
 * @property string|null $about_summary1
 * @property string|null $about_summary1_en
 * @property string|null $about_summary2
 * @property string|null $about_summary2_en
 * @property string|null $about_fact
 * @property string|null $about_fact_en
 * @property string|null $about_image
 * @property string|null $contact_text
 * @property string|null $contact_text_en
 * @property string|null $contact_title
 * @property string|null $contact_title_en
 * @property string|null $contact_content
 * @property string|null $contact_content_en
 * @property int|null $show_index_block
 * @property string|null $site_index_block_1
 * @property string|null $site_index_block_2
 * @property string|null $site_index_block_1_en
 * @property string|null $site_index_block_2_en
 * @property string|null $site_index_bg_map
 * @property string|null $site_index_bg_blog
 * @property string|null $site_title
 * @property string|null $site_description
 * @property int|null $number_post_trending
 * @property int|null $number_post_catalog_home
 * @property int|null $number_post_per_page
 * @property int|null $number_post_like_in_news
 * @property int|null $show_cover_after_summary
 * @property string|null $about2_title
 * @property string|null $about2_title_en
 * @property string|null $about2_summary
 * @property string|null $about2_summary_en
 * @property string|null $about2_image
 * @property string|null $about3_text
 * @property string|null $about3_text_en
 * @property string|null $about3_content
 * @property string|null $about3_content_en
 * @property string|null $sustainability_title
 * @property string|null $sustainability_title_en
 * @property string|null $sustainability_content
 * @property string|null $sustainability_content_en
 * @property string|null $sustainability_seo_title
 * @property string|null $sustainability_seo_description
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_name', 'site_copyright', 'text_homepage'], 'required'],
            [['site_copyright', 'site_copyright_en', 'map', 'showcase_summary', 'showcase_summary_en', 'branches_summary', 'branches_summary_en', 'branches_page_seo_description', 'branches_fist_content', 'branches_fist_content_en', 'service_summary', 'service_summary_en', 'about_summary1', 'about_summary1_en', 'about_summary2', 'about_summary2_en', 'about_fact', 'about_fact_en', 'contact_content', 'contact_content_en', 'site_index_block_1', 'site_index_block_2', 'site_index_block_1_en', 'site_index_block_2_en', 'site_description', 'about2_summary', 'about2_summary_en', 'about3_content', 'about3_content_en', 'sustainability_content', 'sustainability_content_en', 'sustainability_seo_description'], 'string'],
            [['branches_show_default', 'show_service_image', 'show_index_block', 'number_post_trending', 'number_post_catalog_home', 'number_post_per_page', 'number_post_like_in_news', 'show_cover_after_summary'], 'integer'],
            [['site_name', 'site_logo', 'site_logo_small', 'site_source', 'top_text', 'top_email', 'top_hotline', 'site_source_en', 'top_text_en', 'text_homepage', 'showcase_title', 'showcase_title_en', 'branches_text', 'branches_text_en', 'branches_title', 'branches_title_en', 'branches_page_name', 'branches_page_name_en', 'branches_page_seo_title', 'branches_fist_image', 'service_text', 'service_text_en', 'service_title', 'service_title_en', 'service_image', 'about_text', 'about_text_en', 'about_title', 'about_title_en', 'about_image', 'contact_text', 'contact_text_en', 'contact_title', 'contact_title_en', 'site_index_bg_map', 'site_index_bg_blog', 'site_title', 'about2_title', 'about2_title_en', 'about2_image', 'about3_text', 'about3_text_en', 'sustainability_title', 'sustainability_title_en', 'sustainability_seo_title'], 'string', 'max' => 200],
            [['showcase_text', 'showcase_text_en'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_name' => Yii::t('app', 'Site Name'),
            'site_logo' => Yii::t('app', 'Site Logo'),
            'site_logo_small' => Yii::t('app', 'Site Logo Small'),
            'site_copyright' => Yii::t('app', 'Site Copyright'),
            'site_source' => Yii::t('app', 'Site Source'),
            'top_text' => Yii::t('app', 'Top Text'),
            'top_email' => Yii::t('app', 'Top Email'),
            'top_hotline' => Yii::t('app', 'Top Hotline'),
            'site_copyright_en' => Yii::t('app', 'Site Copyright En'),
            'site_source_en' => Yii::t('app', 'Site Source En'),
            'top_text_en' => Yii::t('app', 'Top Text En'),
            'text_homepage' => Yii::t('app', 'Text Homepage'),
            'map' => Yii::t('app', 'Map'),
            'showcase_text' => Yii::t('app', 'Showcase Text'),
            'showcase_text_en' => Yii::t('app', 'Showcase Text En'),
            'showcase_title' => Yii::t('app', 'Showcase Title'),
            'showcase_title_en' => Yii::t('app', 'Showcase Title En'),
            'showcase_summary' => Yii::t('app', 'Showcase Summary'),
            'showcase_summary_en' => Yii::t('app', 'Showcase Summary En'),
            'branches_text' => Yii::t('app', 'Branches Text'),
            'branches_text_en' => Yii::t('app', 'Branches Text En'),
            'branches_title' => Yii::t('app', 'Branches Title'),
            'branches_title_en' => Yii::t('app', 'Branches Title En'),
            'branches_summary' => Yii::t('app', 'Branches Summary'),
            'branches_summary_en' => Yii::t('app', 'Branches Summary En'),
            'branches_page_name' => Yii::t('app', 'Branches Page Name'),
            'branches_page_name_en' => Yii::t('app', 'Branches Page Name En'),
            'branches_page_seo_title' => Yii::t('app', 'Branches Page Seo Title'),
            'branches_page_seo_description' => Yii::t('app', 'Branches Page Seo Description'),
            'branches_fist_content' => Yii::t('app', 'Branches Fist Content'),
            'branches_fist_content_en' => Yii::t('app', 'Branches Fist Content En'),
            'branches_fist_image' => Yii::t('app', 'Branches Fist Image'),
            'branches_show_default' => Yii::t('app', 'Branches Show Default'),
            'service_text' => Yii::t('app', 'Service Text'),
            'service_text_en' => Yii::t('app', 'Service Text En'),
            'service_title' => Yii::t('app', 'Service Title'),
            'service_title_en' => Yii::t('app', 'Service Title En'),
            'service_summary' => Yii::t('app', 'Service Summary'),
            'service_summary_en' => Yii::t('app', 'Service Summary En'),
            'service_image' => Yii::t('app', 'Service Image'),
            'show_service_image' => Yii::t('app', 'Show Service Image'),
            'about_text' => Yii::t('app', 'About Text'),
            'about_text_en' => Yii::t('app', 'About Text En'),
            'about_title' => Yii::t('app', 'About Title'),
            'about_title_en' => Yii::t('app', 'About Title En'),
            'about_summary1' => Yii::t('app', 'About Summary1'),
            'about_summary1_en' => Yii::t('app', 'About Summary1 En'),
            'about_summary2' => Yii::t('app', 'About Summary2'),
            'about_summary2_en' => Yii::t('app', 'About Summary2 En'),
            'about_fact' => Yii::t('app', 'About Fact'),
            'about_fact_en' => Yii::t('app', 'About Fact En'),
            'about_image' => Yii::t('app', 'About Image'),
            'contact_text' => Yii::t('app', 'Contact Text'),
            'contact_text_en' => Yii::t('app', 'Contact Text En'),
            'contact_title' => Yii::t('app', 'Contact Title'),
            'contact_title_en' => Yii::t('app', 'Contact Title En'),
            'contact_content' => Yii::t('app', 'Contact Content'),
            'contact_content_en' => Yii::t('app', 'Contact Content En'),
            'show_index_block' => Yii::t('app', 'Show Index Block'),
            'site_index_block_1' => Yii::t('app', 'Site Index Block 1'),
            'site_index_block_2' => Yii::t('app', 'Site Index Block 2'),
            'site_index_block_1_en' => Yii::t('app', 'Site Index Block 1 En'),
            'site_index_block_2_en' => Yii::t('app', 'Site Index Block 2 En'),
            'site_index_bg_map' => Yii::t('app', 'Site Index Bg Map'),
            'site_index_bg_blog' => Yii::t('app', 'Site Index Bg Blog'),
            'site_title' => Yii::t('app', 'Site Title'),
            'site_description' => Yii::t('app', 'Site Description'),
            'number_post_trending' => Yii::t('app', 'Number Post Trending'),
            'number_post_catalog_home' => Yii::t('app', 'Number Post Catalog Home'),
            'number_post_per_page' => Yii::t('app', 'Number Post Per Page'),
            'number_post_like_in_news' => Yii::t('app', 'Number Post Like In News'),
            'show_cover_after_summary' => Yii::t('app', 'Show Cover After Summary'),
            'about2_title' => Yii::t('app', 'About2 Title'),
            'about2_title_en' => Yii::t('app', 'About2 Title En'),
            'about2_summary' => Yii::t('app', 'About2 Summary'),
            'about2_summary_en' => Yii::t('app', 'About2 Summary En'),
            'about2_image' => Yii::t('app', 'About2 Image'),
            'about3_text' => Yii::t('app', 'About3 Text'),
            'about3_text_en' => Yii::t('app', 'About3 Text En'),
            'about3_content' => Yii::t('app', 'About3 Content'),
            'about3_content_en' => Yii::t('app', 'About3 Content En'),
            'sustainability_title' => Yii::t('app', 'Sustainability Title'),
            'sustainability_title_en' => Yii::t('app', 'Sustainability Title En'),
            'sustainability_content' => Yii::t('app', 'Sustainability Content'),
            'sustainability_content_en' => Yii::t('app', 'Sustainability Content En'),
            'sustainability_seo_title' => Yii::t('app', 'Sustainability Seo Title'),
            'sustainability_seo_description' => Yii::t('app', 'Sustainability Seo Description'),
        ];
    }
}
