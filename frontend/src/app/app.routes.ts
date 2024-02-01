import { Routes } from '@angular/router';
import { HomePageComponent } from './Pages/home-page/home-page.component';
import { AboutPageComponent } from './Pages/about-page/about-page.component';
import { ContactPageComponent } from './Pages/contact-page/contact-page.component';
import { DonationPageComponent } from './Pages/donation-page/donation-page.component';

export const routes: Routes = [
    {path: "", component: HomePageComponent, title: "Home Page"},
    {path: "about", component: AboutPageComponent, title: "About Page"},
    {path: "contact", component: ContactPageComponent, title: "Contact Page"},
    {path: "donate", component: DonationPageComponent, title: "Donation Page"},
];
