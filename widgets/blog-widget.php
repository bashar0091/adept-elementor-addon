<?php
class blog_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blog_widget';
	}

	public function get_title() {
		return esc_html__( 'Adept Blog', 'adept' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'blog', 'slider' ];
	}

	protected function register_controls() {
	
		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'adept' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'adept' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-content h3' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .blog-content h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_des_style',
			[
				'label' => esc_html__( 'Description', 'adept' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'des_color',
			[
				'label' => esc_html__( 'Description Color', 'adept' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-content p' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .blog-content p',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_btn_style',
			[
				'label' => esc_html__( 'Button', 'adept' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Description Color', 'adept' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-content a' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .blog-content a',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <style>
            .blog-item {
                display: flex !important;
                align-items: center;
            }
            .blog-item .blog-content {
            	flex: 1;
                padding: 20px;
                background: var( --e-global-color-astglobalcolor5 );
            }
            .blog-item p {
                margin-bottom: 0;
            }
            .blog-item .blog-img {
            	position: relative;
            }
            .blog-item .blog-img img {
            	width: 100%;
            }
            .blog-date {
            	position: absolute;
                top: 0;
                left: 0;
                background: var( --e-global-color-primary );
                color: #fff;
                width: 69px;
                height: 69px;
                text-align: center;
            }
            .blog-custom .slick-slide {
            	margin: 0 20px;
            }
            .blog-custom .slick-list {
            	margin: 0 -20px;
            }
             .slick-slide img {
                display: inline-block;
            }
            @media (max-width: 767px) {
            	.blog-item {
                	display: block !important;
                }
                .blog-custom .slick-slide {
                    margin: inherit;
                }
                .blog-custom .slick-list {
                    margin: inherit;
                }
            }
        </style>
        <div class="blog-custom">
            <?php 
                $args = array(
                    'post_type' => 'post',
                    'post_per_page' => -1,
                );
                $query = new WP_Query($args);
                while($query -> have_posts()){
                    $query -> the_post();
            ?>
            <div class="blog-item">
                <div class="blog-content">
                    <h3><?php echo get_the_title();?></h3>
                    <p><?php echo get_the_excerpt();?>...</p>
                    <a href="<?php echo get_the_permalink();?>">Read More &rarr;</a>
                </div>
                <div class="blog-img">
                    <div class="blog-date">
                        <p class="date"><?php echo get_the_date('j');?></p>
                        <p class="month"><?php echo get_the_date('M');?></p>
                    </div>
                    <img src="<?php echo get_the_post_thumbnail_url();?>" alt="blog-image">
                </div>
            </div>
            <?php } ?>
        </div>
        
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script>
            jQuery('.blog-custom').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: false,
                responsive: [
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: 1
                      }
                    }
                 ]
            });
        </script>

		<?php
	}
}