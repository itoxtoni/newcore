@extends('layouts.public')
@section('content')

    <!-- Widget-slide -->
    <div class="tf-slider-widget swiper mySwiper">
        <div class="tf-slider swiper-wrapper">
            <div class="tf-banner swiper-slide">
                <div class="image-slider">
                    <img src="{{ asset('zunzo/images/slides/slide5.jpg') }}" alt="image" />
                    <div class="overlay"></div>
                </div>
                <div class="themeflat-container">
                    <div class="slide-item">
                        <div class="silde-content">
                            <span class="flat-sub-slider">SALE UP TO 50% OFF!</span>
                            <h1 class="flat-title-slider">Empowering Your Fitness Journey
                            </h1>
                            <p class="flat-description-slider">The platform that turns aspirations into
                                accomplishments. Join now and unleash your potential in the world of fitness and
                                wellness.
                            </p>
                            <div class="button">
                                <a href="contact.html" class="flat-button">Join our club</a>
                            </div>
                        </div>
                        <div class="box-events-slide">
                            <span class="new-event">new Event </span>
                            <img src="{{ asset('zunzo/images/evtent/new-event.jpg') }}" alt="image event"
                                class="new-event">
                            <div class="content-event">
                                <h2 class="title-event"><a href="event-details.html" class="">marathon event
                                        2023</a>
                                </h2>
                                <ul>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8333 1.07692H11.0833V0.538462C11.0833 0.395653 11.0219 0.258693 10.9125 0.157712C10.8031 0.0567306 10.6547 0 10.5 0C10.3453 0 10.1969 0.0567306 10.0875 0.157712C9.97812 0.258693 9.91667 0.395653 9.91667 0.538462V1.07692H4.08333V0.538462C4.08333 0.395653 4.02187 0.258693 3.91248 0.157712C3.80308 0.0567306 3.65471 0 3.5 0C3.34529 0 3.19692 0.0567306 3.08752 0.157712C2.97812 0.258693 2.91667 0.395653 2.91667 0.538462V1.07692H1.16667C0.857247 1.07692 0.560501 1.19038 0.341709 1.39235C0.122916 1.59431 0 1.86823 0 2.15385V12.9231C0 13.2087 0.122916 13.4826 0.341709 13.6846C0.560501 13.8865 0.857247 14 1.16667 14H12.8333C13.1428 14 13.4395 13.8865 13.6583 13.6846C13.8771 13.4826 14 13.2087 14 12.9231V2.15385C14 1.86823 13.8771 1.59431 13.6583 1.39235C13.4395 1.19038 13.1428 1.07692 12.8333 1.07692ZM12.8333 4.30769H1.16667V2.15385H2.91667V2.69231C2.91667 2.83512 2.97812 2.97208 3.08752 3.07306C3.19692 3.17404 3.34529 3.23077 3.5 3.23077C3.65471 3.23077 3.80308 3.17404 3.91248 3.07306C4.02187 2.97208 4.08333 2.83512 4.08333 2.69231V2.15385H9.91667V2.69231C9.91667 2.83512 9.97812 2.97208 10.0875 3.07306C10.1969 3.17404 10.3453 3.23077 10.5 3.23077C10.6547 3.23077 10.8031 3.17404 10.9125 3.07306C11.0219 2.97208 11.0833 2.83512 11.0833 2.69231V2.15385H12.8333V4.30769Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">oct 20, 2023</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.85714 2.28571C5.50093 2.28571 4.17517 2.68788 3.04752 3.44135C1.91987 4.19482 1.04097 5.26576 0.521972 6.51874C0.0029711 7.77172 -0.132823 9.15046 0.131761 10.4806C0.396345 11.8108 1.04942 13.0326 2.00841 13.9916C2.9674 14.9506 4.18923 15.6037 5.51938 15.8682C6.84954 16.1328 8.22828 15.997 9.48126 15.478C10.7342 14.959 11.8052 14.0801 12.5586 12.9525C13.3121 11.8248 13.7143 10.4991 13.7143 9.14286C13.7122 7.32487 12.9891 5.58193 11.7036 4.29642C10.4181 3.01091 8.67513 2.28779 6.85714 2.28571ZM10.1186 6.69L7.26143 9.54714C7.20834 9.60023 7.14531 9.64235 7.07594 9.67108C7.00657 9.69981 6.93223 9.7146 6.85714 9.7146C6.78206 9.7146 6.70771 9.69981 6.63835 9.67108C6.56898 9.64235 6.50595 9.60023 6.45286 9.54714C6.39977 9.49405 6.35765 9.43102 6.32892 9.36165C6.30019 9.29229 6.2854 9.21794 6.2854 9.14286C6.2854 9.06777 6.30019 8.99343 6.32892 8.92406C6.35765 8.85469 6.39977 8.79166 6.45286 8.73857L9.31 5.88143C9.36309 5.82834 9.42612 5.78622 9.49549 5.75749C9.56486 5.72876 9.6392 5.71397 9.71429 5.71397C9.78937 5.71397 9.86372 5.72876 9.93308 5.75749C10.0025 5.78622 10.0655 5.82834 10.1186 5.88143C10.1717 5.93452 10.2138 5.99755 10.2425 6.06692C10.2712 6.13628 10.286 6.21063 10.286 6.28571C10.286 6.3608 10.2712 6.43514 10.2425 6.50451C10.2138 6.57388 10.1717 6.63691 10.1186 6.69ZM4.57143 0.571428C4.57143 0.419876 4.63163 0.274531 4.7388 0.167368C4.84596 0.0602039 4.99131 0 5.14286 0H8.57143C8.72298 0 8.86833 0.0602039 8.97549 0.167368C9.08265 0.274531 9.14286 0.419876 9.14286 0.571428C9.14286 0.722981 9.08265 0.868326 8.97549 0.975489C8.86833 1.08265 8.72298 1.14286 8.57143 1.14286H5.14286C4.99131 1.14286 4.84596 1.08265 4.7388 0.975489C4.63163 0.868326 4.57143 0.722981 4.57143 0.571428Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">Start 06:00 AM - Until Finish</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="13" height="16" viewBox="0 0 13 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.28578 0C4.61927 0.00189054 3.02155 0.664747 1.84315 1.84315C0.664747 3.02155 0.00189054 4.61927 0 6.28578C0 11.6644 5.71434 15.7266 5.95792 15.8966C6.054 15.9639 6.16847 16 6.28578 16C6.40309 16 6.51756 15.9639 6.61364 15.8966C6.85721 15.7266 12.5716 11.6644 12.5716 6.28578C12.5697 4.61927 11.9068 3.02155 10.7284 1.84315C9.55 0.664747 7.95229 0.00189054 6.28578 0ZM6.28578 4.00004C6.73785 4.00004 7.17978 4.1341 7.55567 4.38526C7.93155 4.63642 8.22452 4.9934 8.39752 5.41106C8.57053 5.82873 8.61579 6.28831 8.5276 6.7317C8.4394 7.17509 8.2217 7.58237 7.90204 7.90204C7.58237 8.2217 7.17509 8.4394 6.7317 8.5276C6.28831 8.61579 5.82873 8.57053 5.41106 8.39752C4.9934 8.22452 4.63642 7.93155 4.38526 7.55567C4.1341 7.17978 4.00004 6.73785 4.00004 6.28578C4.00004 5.67956 4.24086 5.09818 4.66952 4.66952C5.09818 4.24086 5.67956 4.00004 6.28578 4.00004Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">710 1st St. Easton, PA 18042 | Chester County</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-banner swiper-slide">
                <div class="image-slider">
                    <img src="{{ asset('zunzo/images/slides/slide2.jpg') }}" alt="image" />
                    <div class="overlay"></div>
                </div>
                <div class="themeflat-container">
                    <div class="slide-item">
                        <div class="silde-content">
                            <span class="flat-sub-slider">SALE UP TO 50% OFF!</span>
                            <h1 class="flat-title-slider">Run with Passion and Purpose
                            </h1>
                            <p class="flat-description-slider">The platform that turns aspirations
                                into
                                accomplishments. Join now and unleash your potential in the world of fitness and
                                wellness.
                            </p>
                            <div class="button">
                                <a href="contact.html" class="flat-button">Join our club</a>
                            </div>
                        </div>
                        <div class="box-events-slide">
                            <span class="new-event">new Event </span>
                            <img src="{{ asset('zunzo/images/evtent/new-event.jpg') }}" alt=""
                                class="new-event">
                            <div class="content-event">
                                <h2 class="title-event"><a href="event-details.html" class="">marathon event
                                        2023</a>
                                </h2>
                                <ul>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8333 1.07692H11.0833V0.538462C11.0833 0.395653 11.0219 0.258693 10.9125 0.157712C10.8031 0.0567306 10.6547 0 10.5 0C10.3453 0 10.1969 0.0567306 10.0875 0.157712C9.97812 0.258693 9.91667 0.395653 9.91667 0.538462V1.07692H4.08333V0.538462C4.08333 0.395653 4.02187 0.258693 3.91248 0.157712C3.80308 0.0567306 3.65471 0 3.5 0C3.34529 0 3.19692 0.0567306 3.08752 0.157712C2.97812 0.258693 2.91667 0.395653 2.91667 0.538462V1.07692H1.16667C0.857247 1.07692 0.560501 1.19038 0.341709 1.39235C0.122916 1.59431 0 1.86823 0 2.15385V12.9231C0 13.2087 0.122916 13.4826 0.341709 13.6846C0.560501 13.8865 0.857247 14 1.16667 14H12.8333C13.1428 14 13.4395 13.8865 13.6583 13.6846C13.8771 13.4826 14 13.2087 14 12.9231V2.15385C14 1.86823 13.8771 1.59431 13.6583 1.39235C13.4395 1.19038 13.1428 1.07692 12.8333 1.07692ZM12.8333 4.30769H1.16667V2.15385H2.91667V2.69231C2.91667 2.83512 2.97812 2.97208 3.08752 3.07306C3.19692 3.17404 3.34529 3.23077 3.5 3.23077C3.65471 3.23077 3.80308 3.17404 3.91248 3.07306C4.02187 2.97208 4.08333 2.83512 4.08333 2.69231V2.15385H9.91667V2.69231C9.91667 2.83512 9.97812 2.97208 10.0875 3.07306C10.1969 3.17404 10.3453 3.23077 10.5 3.23077C10.6547 3.23077 10.8031 3.17404 10.9125 3.07306C11.0219 2.97208 11.0833 2.83512 11.0833 2.69231V2.15385H12.8333V4.30769Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">oct 20, 2023</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.85714 2.28571C5.50093 2.28571 4.17517 2.68788 3.04752 3.44135C1.91987 4.19482 1.04097 5.26576 0.521972 6.51874C0.0029711 7.77172 -0.132823 9.15046 0.131761 10.4806C0.396345 11.8108 1.04942 13.0326 2.00841 13.9916C2.9674 14.9506 4.18923 15.6037 5.51938 15.8682C6.84954 16.1328 8.22828 15.997 9.48126 15.478C10.7342 14.959 11.8052 14.0801 12.5586 12.9525C13.3121 11.8248 13.7143 10.4991 13.7143 9.14286C13.7122 7.32487 12.9891 5.58193 11.7036 4.29642C10.4181 3.01091 8.67513 2.28779 6.85714 2.28571ZM10.1186 6.69L7.26143 9.54714C7.20834 9.60023 7.14531 9.64235 7.07594 9.67108C7.00657 9.69981 6.93223 9.7146 6.85714 9.7146C6.78206 9.7146 6.70771 9.69981 6.63835 9.67108C6.56898 9.64235 6.50595 9.60023 6.45286 9.54714C6.39977 9.49405 6.35765 9.43102 6.32892 9.36165C6.30019 9.29229 6.2854 9.21794 6.2854 9.14286C6.2854 9.06777 6.30019 8.99343 6.32892 8.92406C6.35765 8.85469 6.39977 8.79166 6.45286 8.73857L9.31 5.88143C9.36309 5.82834 9.42612 5.78622 9.49549 5.75749C9.56486 5.72876 9.6392 5.71397 9.71429 5.71397C9.78937 5.71397 9.86372 5.72876 9.93308 5.75749C10.0025 5.78622 10.0655 5.82834 10.1186 5.88143C10.1717 5.93452 10.2138 5.99755 10.2425 6.06692C10.2712 6.13628 10.286 6.21063 10.286 6.28571C10.286 6.3608 10.2712 6.43514 10.2425 6.50451C10.2138 6.57388 10.1717 6.63691 10.1186 6.69ZM4.57143 0.571428C4.57143 0.419876 4.63163 0.274531 4.7388 0.167368C4.84596 0.0602039 4.99131 0 5.14286 0H8.57143C8.72298 0 8.86833 0.0602039 8.97549 0.167368C9.08265 0.274531 9.14286 0.419876 9.14286 0.571428C9.14286 0.722981 9.08265 0.868326 8.97549 0.975489C8.86833 1.08265 8.72298 1.14286 8.57143 1.14286H5.14286C4.99131 1.14286 4.84596 1.08265 4.7388 0.975489C4.63163 0.868326 4.57143 0.722981 4.57143 0.571428Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">Start 06:00 AM - Until Finish</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="13" height="16" viewBox="0 0 13 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.28578 0C4.61927 0.00189054 3.02155 0.664747 1.84315 1.84315C0.664747 3.02155 0.00189054 4.61927 0 6.28578C0 11.6644 5.71434 15.7266 5.95792 15.8966C6.054 15.9639 6.16847 16 6.28578 16C6.40309 16 6.51756 15.9639 6.61364 15.8966C6.85721 15.7266 12.5716 11.6644 12.5716 6.28578C12.5697 4.61927 11.9068 3.02155 10.7284 1.84315C9.55 0.664747 7.95229 0.00189054 6.28578 0ZM6.28578 4.00004C6.73785 4.00004 7.17978 4.1341 7.55567 4.38526C7.93155 4.63642 8.22452 4.9934 8.39752 5.41106C8.57053 5.82873 8.61579 6.28831 8.5276 6.7317C8.4394 7.17509 8.2217 7.58237 7.90204 7.90204C7.58237 8.2217 7.17509 8.4394 6.7317 8.5276C6.28831 8.61579 5.82873 8.57053 5.41106 8.39752C4.9934 8.22452 4.63642 7.93155 4.38526 7.55567C4.1341 7.17978 4.00004 6.73785 4.00004 6.28578C4.00004 5.67956 4.24086 5.09818 4.66952 4.66952C5.09818 4.24086 5.67956 4.00004 6.28578 4.00004Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">710 1st St. Easton, PA 18042 | Chester County</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-banner swiper-slide">
                <div class="image-slider">
                    <img src="{{ asset('zunzo/images/slides/slide6.jpg') }}" alt="image" />
                    <div class="overlay"></div>
                </div>
                <div class="themeflat-container">
                    <div class="slide-item">
                        <div class="silde-content">
                            <span class="flat-sub-slider">SALE UP TO 50% OFF!</span>
                            <h1 class="flat-title-slider">Find Your Pace, Find Your Tribe
                            </h1>
                            <p class="flat-description-slider">The platform that turns aspirations
                                into
                                accomplishments. Join now and unleash your potential in the world of fitness and
                                wellness.
                            </p>
                            <div class="button">
                                <a href="contact.html" class="flat-button">Join our club</a>
                            </div>
                        </div>
                        <div class="box-events-slide">
                            <span class="new-event">new Event </span>
                            <img src="{{ asset('zunzo/images/evtent/new-event.jpg') }}" alt=""
                                class="new-event">
                            <div class="content-event">
                                <h2 class="title-event"><a href="event-details.html" class="">marathon event
                                        2023</a>
                                </h2>
                                <ul>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8333 1.07692H11.0833V0.538462C11.0833 0.395653 11.0219 0.258693 10.9125 0.157712C10.8031 0.0567306 10.6547 0 10.5 0C10.3453 0 10.1969 0.0567306 10.0875 0.157712C9.97812 0.258693 9.91667 0.395653 9.91667 0.538462V1.07692H4.08333V0.538462C4.08333 0.395653 4.02187 0.258693 3.91248 0.157712C3.80308 0.0567306 3.65471 0 3.5 0C3.34529 0 3.19692 0.0567306 3.08752 0.157712C2.97812 0.258693 2.91667 0.395653 2.91667 0.538462V1.07692H1.16667C0.857247 1.07692 0.560501 1.19038 0.341709 1.39235C0.122916 1.59431 0 1.86823 0 2.15385V12.9231C0 13.2087 0.122916 13.4826 0.341709 13.6846C0.560501 13.8865 0.857247 14 1.16667 14H12.8333C13.1428 14 13.4395 13.8865 13.6583 13.6846C13.8771 13.4826 14 13.2087 14 12.9231V2.15385C14 1.86823 13.8771 1.59431 13.6583 1.39235C13.4395 1.19038 13.1428 1.07692 12.8333 1.07692ZM12.8333 4.30769H1.16667V2.15385H2.91667V2.69231C2.91667 2.83512 2.97812 2.97208 3.08752 3.07306C3.19692 3.17404 3.34529 3.23077 3.5 3.23077C3.65471 3.23077 3.80308 3.17404 3.91248 3.07306C4.02187 2.97208 4.08333 2.83512 4.08333 2.69231V2.15385H9.91667V2.69231C9.91667 2.83512 9.97812 2.97208 10.0875 3.07306C10.1969 3.17404 10.3453 3.23077 10.5 3.23077C10.6547 3.23077 10.8031 3.17404 10.9125 3.07306C11.0219 2.97208 11.0833 2.83512 11.0833 2.69231V2.15385H12.8333V4.30769Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">oct 20, 2023</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.85714 2.28571C5.50093 2.28571 4.17517 2.68788 3.04752 3.44135C1.91987 4.19482 1.04097 5.26576 0.521972 6.51874C0.0029711 7.77172 -0.132823 9.15046 0.131761 10.4806C0.396345 11.8108 1.04942 13.0326 2.00841 13.9916C2.9674 14.9506 4.18923 15.6037 5.51938 15.8682C6.84954 16.1328 8.22828 15.997 9.48126 15.478C10.7342 14.959 11.8052 14.0801 12.5586 12.9525C13.3121 11.8248 13.7143 10.4991 13.7143 9.14286C13.7122 7.32487 12.9891 5.58193 11.7036 4.29642C10.4181 3.01091 8.67513 2.28779 6.85714 2.28571ZM10.1186 6.69L7.26143 9.54714C7.20834 9.60023 7.14531 9.64235 7.07594 9.67108C7.00657 9.69981 6.93223 9.7146 6.85714 9.7146C6.78206 9.7146 6.70771 9.69981 6.63835 9.67108C6.56898 9.64235 6.50595 9.60023 6.45286 9.54714C6.39977 9.49405 6.35765 9.43102 6.32892 9.36165C6.30019 9.29229 6.2854 9.21794 6.2854 9.14286C6.2854 9.06777 6.30019 8.99343 6.32892 8.92406C6.35765 8.85469 6.39977 8.79166 6.45286 8.73857L9.31 5.88143C9.36309 5.82834 9.42612 5.78622 9.49549 5.75749C9.56486 5.72876 9.6392 5.71397 9.71429 5.71397C9.78937 5.71397 9.86372 5.72876 9.93308 5.75749C10.0025 5.78622 10.0655 5.82834 10.1186 5.88143C10.1717 5.93452 10.2138 5.99755 10.2425 6.06692C10.2712 6.13628 10.286 6.21063 10.286 6.28571C10.286 6.3608 10.2712 6.43514 10.2425 6.50451C10.2138 6.57388 10.1717 6.63691 10.1186 6.69ZM4.57143 0.571428C4.57143 0.419876 4.63163 0.274531 4.7388 0.167368C4.84596 0.0602039 4.99131 0 5.14286 0H8.57143C8.72298 0 8.86833 0.0602039 8.97549 0.167368C9.08265 0.274531 9.14286 0.419876 9.14286 0.571428C9.14286 0.722981 9.08265 0.868326 8.97549 0.975489C8.86833 1.08265 8.72298 1.14286 8.57143 1.14286H5.14286C4.99131 1.14286 4.84596 1.08265 4.7388 0.975489C4.63163 0.868326 4.57143 0.722981 4.57143 0.571428Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">Start 06:00 AM - Until Finish</a>
                                    </li>
                                    <li>
                                        <span class="icon-new">
                                            <svg width="13" height="16" viewBox="0 0 13 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.28578 0C4.61927 0.00189054 3.02155 0.664747 1.84315 1.84315C0.664747 3.02155 0.00189054 4.61927 0 6.28578C0 11.6644 5.71434 15.7266 5.95792 15.8966C6.054 15.9639 6.16847 16 6.28578 16C6.40309 16 6.51756 15.9639 6.61364 15.8966C6.85721 15.7266 12.5716 11.6644 12.5716 6.28578C12.5697 4.61927 11.9068 3.02155 10.7284 1.84315C9.55 0.664747 7.95229 0.00189054 6.28578 0ZM6.28578 4.00004C6.73785 4.00004 7.17978 4.1341 7.55567 4.38526C7.93155 4.63642 8.22452 4.9934 8.39752 5.41106C8.57053 5.82873 8.61579 6.28831 8.5276 6.7317C8.4394 7.17509 8.2217 7.58237 7.90204 7.90204C7.58237 8.2217 7.17509 8.4394 6.7317 8.5276C6.28831 8.61579 5.82873 8.57053 5.41106 8.39752C4.9934 8.22452 4.63642 7.93155 4.38526 7.55567C4.1341 7.17978 4.00004 6.73785 4.00004 6.28578C4.00004 5.67956 4.24086 5.09818 4.66952 4.66952C5.09818 4.24086 5.67956 4.00004 6.28578 4.00004Z"
                                                    fill="#C3E92D" />
                                            </svg>
                                        </span>
                                        <a href="event-details.html">710 1st St. Easton, PA 18042 | Chester County</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div><!-- Widget-slide -->

    <!-- Logo partner -->
    <div class="tf-widget-partner background-black">
        <div class="themeflat-container">
            <div class="tf-partner">
                <div class="sologan-logo">
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/5.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/2.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/3.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/4.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/6.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/1.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/5.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/2.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/3.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/4.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/6.png') }}" alt="image logo">
                    </a>
                    <a href="#">
                        <img class="image-logo" src="{{ asset('zunzo/images/retinal/1.png') }}" alt="image logo">
                    </a>
                </div>
            </div>
        </div>
    </div><!-- Logo partner -->

    <!-- Widget-about -->
    <div class="tf-widget-about-us main-content">
        <div class="themeflat-container">
            <div class="tf-about-us">
                <div class="row">
                    <div class="col-md-6 image-wraper">
                        <div class="media">
                            <div class="media-v1 wow fadeInLeft animated">
                                <img class="mask-media" src="{{ asset('zunzo/images/about/mask1.png') }}"
                                    alt="image">
                                <img class="shape-media" src="{{ asset('zunzo/images/about/graphic.png') }}"
                                    alt="image">
                            </div>
                            <img src="{{ asset('zunzo/images/about/mask2.png') }}" alt="image"
                                class="image-gr wow fadeInRight animated">
                            <img src="{{ asset('zunzo/images/about/Intersect.png') }}" alt="image"
                                class="intersect-img">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-box">
                            <img src="{{ asset('zunzo/images/about/graphic-box.png') }}" alt="image shape">
                            <!-- header style v1 -->
                            <div class="title-box title-small-v2">
                                <span class="sub-title wow fadeInUp animated">Welcome to runclub!</span>
                                <h2 class="title-section wow fadeInUp animated">Zunzo - Your Ultimate Running Community
                                </h2>
                            </div><!-- header style v1 -->
                            <p class="post wow fadeInUp animated">
                                Welcome to our vibrant running community, where we organize exciting running events,
                                provide helpful running tutorials, and keep you informed with the latest running news.
                            </p>
                            <div class="line"></div>
                            <div class="about-button-group">
                                <button class="flat-button wow fadeInUp animated">Find out more</button>
                                <div class="infor-about">
                                    <img src="{{ asset('zunzo/images/about/info.png') }}" alt="">
                                    <div class="info">
                                        <div class="name wow fadeInUp animated">Chris pad</div>
                                        <div class="job wow fadeInUp animated">Co - Founder Zunzo</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Widget-about  -->

     <!-- wiget benefits -->
     <div class="tf-widget-benefit background-black">
        <div class="themeflat-container">
            <div class="tf-benefit">
                <!-- header style v2 -->
                <div class="title-box-v2 center-title-box title-large">
                    <span class="sub-title wow fadeInUp animated">running's benefits</span>
                    <h2 class="title-section wow fadeInUp animated">Benefits of running reference</h2>
                </div><!-- header style v2 -->
                <div class="benefit-wrap-content">
                    <div class="row">
                        <div class="col-md-4 benefit-on-left">
                            <div class="benefit-item">
                                <div class="benefit-content">
                                    <h6 class="title-benefit wow fadeInLeft animated">
                                        Be healthy
                                    </h6>
                                    <p class="description-benefit wow fadeInLeft animated">
                                        Improve your physical fitness and well-being through regular running.
                                    </p>
                                </div>
                                <div class="benefit-number">
                                    <span class="number wow zoomIn animated">01</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-content">
                                    <h6 class="title-benefit wow fadeInLeft animated">
                                        Feel Free
                                    </h6>
                                    <p class="description-benefit wow fadeInLeft animated">
                                        Experience the freedom of running outdoors, and challenging yourself.
                                    </p>
                                </div>
                                <div class="benefit-number">
                                    <span class="number wow zoomIn animated">02</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 benefit-center ">
                            <div class="benefit-video">

                                <img class="video" src="{{ asset('zunzo/images/retinal/video.jpg') }}" alt="">

                            </div>

                        </div>
                        <div class="col-md-4 benefit-on-right">
                            <div class="benefit-item">
                                <div class="benefit-number">
                                    <span class="number wow zoomIn animated">03</span>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="title-benefit wow fadeInRight animated">
                                        Be one of us
                                    </h6>
                                    <p class="description-benefit wow fadeInRight animated">
                                        Join a supportive community of like-minded runners and achieving goals together.
                                    </p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-number">
                                    <span class="number wow zoomIn animated">04</span>
                                </div>
                                <div class="benefit-content">
                                    <h6 class="title-benefit wow fadeInRight animated">
                                        be strong</h6>
                                    <p class="description-benefit wow fadeInRight animated">
                                        Build resilience and mental toughness as you push your limits.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- wiget benefits -->

    <!-- widge Form register -->
    <div class="widget-form-register">
        <div class="row">
            <div class="col-md-6 pd-form image-register">
                <img src="{{ asset('zunzo/images/retinal/img-form.jpg') }}" alt="image">
            </div>
            <div class="col-md-6 pd-form">
                <div class="widget-register background-green">
                    <div class="heading-register">
                        <h2 class="title-register">Registration Form</h2>
                    </div>

                    <div class="form-register">

                        @livewire('register-form')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- widge Form register -->

@endsection
