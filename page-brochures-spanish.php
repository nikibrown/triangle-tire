<?php
/**
 *
 * Template Name: Brochures Spanish
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
get_header();


    // Start the loop.
    while ( have_posts() ) : the_post();

        $img = featured_image( $post->ID, 'full');
        $gallery = get_post_gallery( $post->ID, false );
        //$gallery = array_unique( $gallery );
        $ids = explode( ",", $gallery['ids'] );
        $pics = array();
        if( !empty( $ids ) )
        {
            foreach( $ids as $id )
            {
                $pics[] = wp_get_attachment_url( $id );
            }
            $pics = array_unique( $pics );
        }
        $pics = array_filter( $pics );
        ?>

        <?php
        if( !empty( $img ) || !empty( $pics ) )
        {
            ?>
            <div class="interiorbanner expanded row">
                <div class="large-12">
                    <?php
                    if( !empty( $pics ) )
                    {
                        echo '<div class="js-gallery" style="height: 300px; max-height: 300px; overflow: hidden;">';
                        foreach( $pics as $g )
                        {
                            echo '<img src="'. $g .'" />';
                        }
                        echo '</div>';
                    }
                    else
                    {
                        echo '<img src="'.$img.'" />';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <div class="medium-12 columns">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns divider"><hr></div>
        </div>
        <div id="brochures" class="row brochurerow">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2302" src="http://triangletireus.com/wp-content/uploads/2018/10/comtire-productguide.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">2018 Commercial Tires Product Guide</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_Commercial_product-guide-2018.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2305" src="http://triangletireus.com/wp-content/uploads/2018/10/otr-productguide.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">2018 Off-the_Road Tires Product Guide</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_OTR_product-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns"></div>
         </div>
         <div class="row">
            <div class="medium-12 columns">
               <h1 class="headersections">Guías de bolsillo de productos</h1>
            </div>
         </div>
         <div class="row">
            <div class="large-12 columns divider">
               <hr />
            </div>
         </div>
         <div class="row brochurerow">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2303" src="http://triangletireus.com/wp-content/uploads/2018/10/comtirepocket.jpg" alt="" width="300" height="150" />
               <p class="supporttitle">2018 Commercial Tires Pocket Guide</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_Commercial_pocket-guide_2018.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2306" src="http://triangletireus.com/wp-content/uploads/2018/10/otrtirepocket.jpg" alt="" width="300" height="150" />
               <p class="supporttitle">2018 Off-the_Road Tires Pocket Guide</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_OTR_pocket-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2306" src="http://triangletireus.com/wp-content/uploads/2018/10/sttirepocket.jpg" alt="" width="300" height="150" />
               <p class="supporttitle">Triangle ST Pocket Guide CVR</p>
               <a href="/wp-content/uploads/2020/05/Triangle_ST_radial.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
         <div class="row brochurerow secondrowsupport">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2306" src="http://triangletireus.com/wp-content/uploads/2018/10/uhptirepocket.jpg" alt="" width="300" height="150" />
               <p class="supporttitle">Triangle UHP Pocket Guide CVR</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_UHP_pocket-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns"></div>
            <div class="large-4 columns"></div>
         </div>
         <div class="row">
            <div class="medium-12 columns">
               <h1 class="headersections">Garantías</h1>
            </div>
         </div>
         <div class="row">
            <div class="large-12 columns divider">
               <hr />
            </div>
         </div>
         <div id="warranties" class="row brochurerow">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2300" src="http://triangletireus.com/wp-content/uploads/2017/06/pwarranty-232x300.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Passenger Tire Warranty</p>
               <a href="http://triangletireus.com/wp-content/uploads/2017/06/Triangle_PCR_limited_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2309" src="http://triangletireus.com/wp-content/uploads/2018/10/comwarranty.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Truck &amp; Bus Radial Tire Warranty</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_TBR_warranty_card_8x9-FOLDED.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2301" src="http://triangletireus.com/wp-content/uploads/2018/10/stwarranty.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">ST Radial Warranty</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_ST_warranty_card_8x9-FOLDED.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
         <div class="row brochurerow secondrowsupport">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2297" src="http://triangletireus.com/wp-content/uploads/2017/06/offwarranty-232x300.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Off-the-Road Tire Warranty</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/09/2018_Triangle_OTR_limited_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2307" src="http://triangletireus.com/wp-content/uploads/2017/06/tbsatisfaction-232x300.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Truck &amp; Bus Tire Satisfaction Promise</p>
               <a href="http://triangletireus.com/wp-content/uploads/2017/06/Triangle_TBR_90day_satisfaction.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2299" src="http://triangletireus.com/wp-content/uploads/2017/06/otrliability-232x300.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">OTR Product Liability Claims Procedures</p>
               <a href="http://triangletireus.com/wp-content/uploads/2017/06/Triangle_OTR_liability_claim.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
          <div class="row brochurerow secondrowsupport">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2297" src="http://triangletireus.com/wp-content/uploads/2018/09/otr30day.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">OTR 30 Day Satisfaction</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/09/Triangle_OTR_30day_satisfaction_2108.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2307" src="http://triangletireus.com/wp-content/uploads/2018/09/st90.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">ST Radial 90 Day Satisfaction</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/09/Triangle_ST-Radial_90day_satisfaction_2018.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2299" src="http://triangletireus.com/wp-content/uploads/2018/09/tbr90.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">TBR 90 Day Satisfaction</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/09/Triangle_TBR_90day_satisfaction_2108.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
         <!--<div class="row">
            <div class="medium-12 columns">
               <h1 class="headersections">Forms</h1>
            </div>
         </div>
         <div class="row">
            <div class="large-12 columns divider">
               <hr />
            </div>
         </div>
         <div class="row">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2308" src="http://triangletireus.com/wp-content/uploads/2017/06/tbradjustment-300x231.jpg" alt="" width="300" height="231" />
               <p class="supporttitle">TBR Adjustment/Inspection Report</p>
               <a href="http://triangletireus.com/wp-content/uploads/2017/06/TBR_adjustment_form.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2298" src="http://triangletireus.com/wp-content/uploads/2017/06/otradjustment-300x232.jpg" alt="" width="300" height="232" />
               <p class="supporttitle">OTR Adjustment/Inspection Report</p>
               <a href="http://triangletireus.com/wp-content/uploads/2017/06/OTR_adjustment_form.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns"></div>
         </div>-->
         <div class="row">
            <div class="medium-12 columns">
               <h1 class="headersections">Folletos</h1>
            </div>
         </div>
         <div class="row">
            <div class="large-12 columns divider">
               <hr />
            </div>
         </div>
         <div class="row brochurerow">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2308" src="http://tt.devbuilds.site/wp-content/uploads/2019/02/triangle-corporate-brochure.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Triangle Corporate Brochure CVR</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_corporate_brochure.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
            	<img class="alignnone size-medium wp-image-2299" src="http://triangletireus.com/wp-content/uploads/2018/10/tr653productsheet.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Triangle TR653 Product Sheet</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_TR653_product_sheet-1.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
            	<img class="alignnone size-medium wp-image-2299" src="http://triangletireus.com/wp-content/uploads/2018/10/trs02productsheet.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Triangle TRS02 Product Sheet</p>
               <a href="http://triangletireus.com/wp-content/uploads/2018/10/Triangle_TRS02_product_sheet-1.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        // End the loop.
    endwhile;

get_footer();