<aside class="main-sidebar" style="margin-top: 60px;">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="treeview mt-2">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active' : '' }}">
                    <i class="fa fa-laptop"></i> <span>Dashboard</span>
                </a>
            </li>
            @can('role-list')
                <li class="treeview">
                    <a href="{{ route('role.index') }}"
                        class="{{ request()->is('role') || request()->is('role/create') || request()->is('role/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-user-plus"></i> <span>Roles</span>
                    </a>
                </li>
            @endcan
            @can('permission-list')
                <li class="treeview">
                    <a href="{{ route('permission.index') }}"
                        class="{{ request()->is('permission') || request()->is('permission/create') || request()->is('permission/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-lock"></i> <span>Permissions</span>
                    </a>
                </li>
            @endcan

            <li class="treeview {{ request()->is('page') || request()->is('page/*') || request()->is('page_setting/*') || request()->is('package') || request()->is('package/create') || request()->is('package/*/edit') || request()->is('event') || request()->is('event/create') || request()->is('event/*/edit') || request()->is('event/*') ? 'active' : '' }}"
                style="height: auto;">
                <a href="#"
                    class="{{ request()->is('page') || request()->is('page/*') || request()->is('page_setting/*') || request()->is('package') || request()->is('package/create') || request()->is('package/*/edit') || request()->is('event') || request()->is('event/create') || request()->is('event/*/edit') || request()->is('event/*') ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Website Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu"
                    style="display: {{ request()->is('page') || request()->is('page/*') || request()->is('page_setting/*') || request()->is('package') || request()->is('package/create') || request()->is('package/*/edit') || request()->is('event') || request()->is('event/create') || request()->is('event/*/edit') || request()->is('event/*') ? 'block' : 'none' }};">
                    @can('page-list')
                        <li class="treeview mt-2">
                            <a href="{{ route('page.index') }}"
                                class="{{ request()->is('page') || request()->is('page/*') || request()->is('page_setting/*') ? 'active' : '' }}">
                                <i class="fa fa-cog"></i> <span>Site Settings CMS</span>
                            </a>
                        </li>
                    @endcan


                    {{-- @can('event-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('event.index') }}"
                            class="{{ request()->is('event') || request()->is('event/create') || request()->is('event/*/edit') || request()->is('event/*') ? 'active' : '' }}">
                            <i class="fa fa-calendar"></i> <span>Events</span>
                        </a>
                    </li>
                    @endcan


                    {{-- @can('package-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('package.index') }}"
                            class="{{ request()->is('package') || request()->is('package/create') || request()->is('package/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-gift"></i> <span>All Packages</span>
                        </a>
                    </li>
                    @endcan --}}


                </ul>
            </li>
            @can('homeslider-list')
                <li class="treeview">
                    <a href="{{ route('homeslider.index') }}"
                        class="{{ request()->is('homeslider') || request()->is('homeslider/create') || request()->is('homeslider/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-tasks"></i> <span>Home Banner Slider</span>
                    </a>
                </li>
            @endcan
            @can('banner-list')
                <li class="treeview mt-2">
                    <a href="{{ route('banner.index') }}"
                        class="{{ request()->is('banner') || request()->is('banner/create') || request()->is('banner/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-picture-o"></i> <span>All Banners</span>
                    </a>
                </li>
            @endcan

            @can('services-list')
                <li class="treeview">
                    <a href="{{ route('services.index') }}"
                        class="{{ request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-code-fork"></i> <span>All Services</span>
                    </a>
                </li>
            @endcan

            @can('trainer-list')
                <li class="treeview mt-2">
                    <a href="{{ route('trainer.index') }}"
                        class="{{ request()->is('trainer') || request()->is('trainer/create') || request()->is('trainer/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-users"></i> <span>Trainers</span>
                    </a>
                </li>
            @endcan
            @can('testimonial-list')
                <li class="treeview">
                    <a href="{{ route('testimonial.index') }}"
                        class="{{ request()->is('testimonial') || request()->is('testimonial/create') || request()->is('testimonial/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-id-card-o"></i> <span>Testimonials</span>
                    </a>
                </li>
            @endcan

            @can('contactus-list')
                <li class="treeview mt-2">
                    <a href="{{ route('contactus.index') }}" class="{{ request()->is('contactus') ? 'active' : '' }}">
                        <i class="fa fa-envelope"></i> <span>Free Trial Signup</span>
                    </a>
                </li>
            @endcan
            @can('contact-list')
                <li class="treeview mt-2">
                    <a href="{{ route('contact.index') }}" class="{{ request()->is('contact') ? 'active' : '' }}">
                        <i class="fa fa-envelope"></i> <span>All Contact Us</span>
                    </a>
                </li>
            @endcan

            @can('appointment-list')
                <li class="treeview">
                    <a href="{{ route('appointment.index') }}"
                        class="{{ request()->is('appointment') || request()->is('appointment/create') || request()->is('appointment/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-calendar"></i> <span>Appointments</span>
                    </a>
                </li>
            @endcan

            <li class="treeview {{ (request()->is('blog_category') || request()->is('blog_category/create') || request()->is('blog_category/*/edit') || request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit')) ? 'active' : '' }}"
                style="height: auto;">
                <a href="#"
                    class="{{ (request()->is('blog_category') || request()->is('blog_category/create') || request()->is('blog_category/*/edit') || request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>All Blogs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"
                    style="display: {{ (request()->is('blog_category') || request()->is('blog_category/create') || request()->is('blog_category/*/edit') || request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit')) ? 'block' : 'none' }};">

                    @can('blog_category-list')
                        <li class="treeview">
                            <a href="{{ route('blog_category.index') }}"
                                class="{{ request()->is('blog_category') || request()->is('blog_category/create') || request()->is('blog_category/*/edit') ? 'active' : '' }}">
                                <i class="fa fa-code-fork"></i> <span>All Blog Categories</span>
                            </a>
                        </li>
                    @endcan

                    @can('blog-list')
                        <li class="treeview">
                            <a href="{{ route('blog.index') }}"
                                class="{{ request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit') ? 'active' : '' }}">
                                <i class="fa fa-sitemap"></i> <span>Blogs</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            {{-- <li
                class="treeview {{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit') || request()->is('jobcategory') || request()->is('jobcategory/create') || request()->is('jobcategory/*/edit') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*') ) ? 'active' : '' }}"
                style="height: auto;">
                <a href="#"
                    class="{{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit') || request()->is('jobcategory') || request()->is('jobcategory/create') || request()->is('jobcategory/*/edit') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*') ) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Project Hub Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"
                    style="display: {{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('jobpost') || request()->is('jobpost/create') || request()->is('jobpost/*/edit') || request()->is('jobcategory') || request()->is('jobcategory/create') || request()->is('jobcategory/*/edit') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*') ) ? 'block' : 'none' }};">

                    <li class="treeview mt-2 {{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*')) ? 'active' : '' }}"
                        style="height: auto;">
                        <a href="#"
                            class="{{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*')) ? 'active' : '' }}">
                            <i class="fa fa-files-o"></i>
                            <span>Project Management</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu"
                            style="display: {{ (request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') || request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') || request()->is('documents/*')) ? 'block' : 'none' }};">



                            @can('projects-list')
                            <li class="treeview mt-2">
                                <a href="{{ route('projects.index') }}"
                                    class="{{ request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('projects/*') ? 'active' : '' }}">
                                    <i class="fa fa-sitemap"></i> <span>Project Listings</span>
                                </a>
                            </li>
                            @endcan


                            @can('client_contact-list')
                            <li class="treeview">
                                <a href="{{ route('client_contact.index') }}"
                                    class="{{ request()->is('client_contact') || request()->is('client_contact/create') || request()->is('client_contact/*/edit') ? 'active' : '' }}">
                                    <i class="fa fa-tasks"></i> <span>Client Contact</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </li> --}}







            {{-- <li
                class="treeview {{ (request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}"
                style="height: auto;">
                <a href="#"
                    class="{{ (request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') || request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Member Directory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"
                    style="display: {{ (request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit') || request()->is('services') || request()->is('services/create') || request()->is('services/*/edit')) ? 'block' : 'none' }};">

                    @can('services-list')
                    <li class="treeview">
                        <a href="{{ route('services.index') }}"
                            class="{{ request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>All Services</span>
                        </a>
                    </li>
                    @endcan

                    @can('member_directory-list')
                    <li class="treeview">
                        <a href="{{ route('member_directory.index') }}"
                            class="{{ request()->is('member_directory') || request()->is('member_directory/create') || request()->is('member_directory/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-sitemap"></i> <span>Member Directory</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li> --}}



            {{-- <!--@can('user-list')
            <li class="treeview">
                <a href="{{ route('user.index') }}" class="{{ request()->is('user') || request()->is('user/create') || request()->is('user/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-users"></i> <span>All Users</span>
                </a>
            </li>
            @endcan-->

            <!--

            
            @can('our_sponsor-list')
            <li class="treeview">
                <a href="{{ route('our_sponsor.index') }}" class="{{ request()->is('our_sponsor') || request()->is('our_sponsor/create') || request()->is('our_sponsor/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Our Sponsors</span>
            </a>
            </li>
            @endcan -->

            <!--  @can('contactus-list')
            <li class="treeview">
                <a href="{{ route('contactus.index') }}" class="{{ request()->is('contactus')? 'active' : '' }}">
                    <i class="fa fa-tasks"></i> <span>All Contact Us</span>
                </a>
            </li>
            @endcan -->

            --}}

            {{-- <!--  <li class="treeview {{ Route::is('daily_activity.*') ? 'active' : '' }}">
                <a href="#" class="treeview {{ Route::is('daily_activity.*') ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i> <span>Daily Activity</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: {{ Route::is('daily_activity.*') ? 'block' : 'none' }};">
                    <li>
                        <a href="{{ route('daily_activity.index') }}" class="{{ Route::is('daily_activity.index') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>All Daily Activities</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('daily_activity.create') }}" class="{{ Route::is('daily_activity.create') ? 'active' : '' }}">
                            <i class="fa fa-plus"></i> <span>Add Daily Activity</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Route::is('bonus_activity.*') ? 'active' : '' }}">
                <a href="#" class="treeview {{ Route::is('bonus_activity.*') ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i> <span>Bonus Activity</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: {{ Route::is('bonus_activity.*') ? 'block' : 'none' }};">
                    <li>
                        <a href="{{ route('bonus_activity.index') }}" class="{{ Route::is('bonus_activity.index') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>All Bonus Activities</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bonus_activity.create') }}" class="{{ Route::is('bonus_activity.create') ? 'active' : '' }}">
                            <i class="fa fa-plus"></i> <span>Add Bonus Activity</span>
                        </a>
                    </li>
                </ul>
            </li> --> --}}

            {{-- @can('jobpost-list')
            <li class="treeview">
                <a href="#" class="">
                    <i class="fa fa-handshake-o"></i> <span>Jobs Management</span>
                </a>
            </li>
            @endcan

            <li class="treeview">
                <a href="#" class="">
                    <i class="fa fa-handshake-o"></i> <span>Proposals Management</span>
                </a>
            </li> --}}

            {{-- @can('testimonial-list')
            <li class="treeview">
                <a href="{{ route('testimonial.index') }}"
                    class="{{ request()->is('testimonial') || request()->is('testimonial/create') || request()->is('testimonial/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-id-card-o"></i> <span>Testimonials</span>
                </a>
            </li>
            @endcan --}}


            {{-- <!-- <li class="treeview {{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit')) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ (request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') || request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit')) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Project Listings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu" style="display: {{ (request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') || request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit')) ? 'block' : 'none' }};">
                

                    @can('project_category-list')
                    <li class="treeview">
                        <a href="{{ route('project_category.index') }}" class="{{ request()->is('project_category') || request()->is('project_category/create') || request()->is('project_category/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>Project Categories</span>
                        </a>
                    </li>
                    @endcan
                   
                    @can('projects-list')
                    <li class="treeview">
                        <a href="{{ route('projects.index') }}" class="{{ request()->is('projects') || request()->is('projects/create') || request()->is('projects/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-sitemap"></i> <span>Project Listings</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
           
            @can('documents-list')
                <li class="treeview">
                    <a href="{{ route('documents.index') }}" class="{{ request()->is('documents') || request()->is('documents/create') || request()->is('documents/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-files-o"></i> <span>Document Repository</span>
                    </a>
                </li>
            @endcan--> --}}





            {{-- <!--  @can('about-list')
            <li class="treeview">
                <a href="{{ route('about.index') }}" class="{{ request()->is('about') || request()->is('about/create') || request()->is('about/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i> <span>Home About Us</span>
                </a>
            </li>
            @endcan -->

            <!-- @can('services-list')
            <li class="treeview">
                <a href="{{ route('services.index') }}" class="{{ request()->is('services') || request()->is('services/create') || request()->is('services/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-code-fork"></i> <span>All Services</span>
                </a>
            </li>
            @endcan -->

            <!--  @can('advertisement-list')
            <li class="treeview">
                <a href="{{ route('advertisement.index') }}" class="{{ request()->is('advertisement') || request()->is('advertisement/create') || request()->is('advertisement/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-picture-o"></i> <span>All Advertisements</span>
                </a>
            </li>
            @endcan -->

            <!--  @can('newsletter-list')
            <li class="treeview">
                <a href="{{ route('newsletter.index') }}" class="{{ request()->is('newsletter') || request()->is('newsletter/create') || request()->is('newsletter/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-newspaper-o"></i> <span>All Newsletter</span>
                </a>
            </li>
            @endcan -->
            <!--  @can('properties_area-list')
            <li class="treeview">
                <a href="{{ route('properties_area.index') }}" class="{{ request()->is('properties_area') || request()->is('properties_area/create') || request()->is('properties_area/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-map-signs"></i> <span>All Properties Area</span>
                </a>
            </li>
            @endcan -->
            <!-- @can('faq-list')
            <li class="treeview">
                <a href="{{ route('faq.index') }}" class="{{ request()->is('faq') || request()->is('faq/create') || request()->is('faq/*/edit') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i> <span>FAQs</span>
                </a>
            </li>
            @endcan -->






            <!--  @can('booking-list')
            <li class="treeview">
                <a href="{{ route('booking.index') }}" class="{{ request()->is('booking') || request()->is('booking/create') || request()->is('booking/*/edit') ? 'active' : '' }}">
            <i class="fa fa-calendar"></i> <span>Bookings</span>
            </a>
            </li>
            @endcan-->


            <!-- @can('product-list')
            <li class="treeview">
                <a href="{{ route('product.index') }}" class="{{ request()->is('product') || request()->is('product/create') || request()->is('product/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Products</span>
            </a>
            </li>
            @endcan 
             @can('deals-list')
            <li class="treeview">
                <a href="{{ route('deals.index') }}" class="{{ request()->is('deals') || request()->is('deals/create') || request()->is('deals/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Deals</span>
            </a>
            </li>
            @endcan 
            @can('career-list')
            <li class="treeview">
                <a href="{{ route('career.index') }}" class="{{ request()->is('career') || request()->is('career/show') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Career</span>
            </a>
            </li>
            @endcan 
            @can('contact-list')
            <li class="treeview">
                <a href="{{ route('contact.index') }}" class="{{ request()->is('contact') || request()->is('contact/create') || request()->is('contact/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Contact</span>
            </a>
            </li>
            @endcan 

            
            @can('agents-list')
            <li class="treeview">
                <a href="{{ route('agents.index') }}" class="{{ request()->is('agents') || request()->is('agents/create') || request()->is('agents/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Our Agents</span>
            </a>
            </li>
            @endcan 

            @can('gallery-list')
            <li class="treeview">
                <a href="{{ route('gallery.index') }}" class="{{ request()->is('gallery') || request()->is('gallery/create') || request()->is('gallery/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Gallery</span>
            </a>
            </li>
            @endcan  -->
            <!-- @can('car_rent-list')
            <li class="treeview">
                <a href="{{ route('how_to_rent.index') }}" class="{{ request()->is('how_to_rent') || request()->is('how_to_rent/create') || request()->is('how_to_rent/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Agents</span>
            </a>
            </li>
            @endcan 

            @can('faq-list')
                <li class="treeview">
                    <a href="{{ route('faq.index') }}" class="{{ request()->is('faq') || request()->is('faq/create') || request()->is('faq/*/edit') ? 'active' : '' }}">
            <i class="fa fa-question-circle"></i> <span>Faqs</span>
            </a>
            </li>
            @endcan 


            @can('virtualtour-list')
            <li class="treeview">
                <a href="{{ route('tour.index') }}" class="{{ request()->is('tour') || request()->is('tour/create') || request()->is('tour/*/edit') ? 'active' : '' }}">
            <i class="fa fa-tasks"></i> <span>Virtual Tour</span>
            </a>
            </li>
            @endcan --> --}}
        </ul>
    </section>
</aside>