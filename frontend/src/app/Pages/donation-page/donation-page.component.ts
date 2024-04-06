import { Component, inject, ViewChild, ElementRef } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {
  FormsModule,
  ReactiveFormsModule,
  FormGroup,
  FormControl,
  Validators,
} from '@angular/forms';
import { CommonModule } from '@angular/common';

import { environment } from '../../../environments/environment.development';

@Component({
  selector: 'app-donation-page',
  standalone: true,
  imports: [CommonModule, FormsModule, ReactiveFormsModule],
  templateUrl: './donation-page.component.html',
  styleUrl: './donation-page.component.css',
})


export class DonationPageComponent {

  
  paymentHandler: any = null;
  stripeAPIKey: any = environment.stripeKey;

  ngOnInit() {
    this.invokeStripe();
  }

  invokeStripe() {
    if (!window.document.getElementById('stripe-script')) {
      const script = window.document.createElement('script');
    
      script.id = 'stripe-script';
      script.type = 'text/javascript';
      script.src = 'https://checkout.stripe.com/checkout.js';
      script.onload = () => {
        this.paymentHandler = (<any>window).StripeCheckout.configure({
          key: this.stripeAPIKey,
          locale: 'auto',
          token: function (stripeToken: any) {
            console.log(stripeToken);
            alert('Payment has been successfull!');
          },
        });
      };
  
      window.document.body.appendChild(script);
    }
  }

  makePayment(amount: any) {
    const paymentHandler = (<any>window).StripeCheckout.configure({
      key: this.stripeAPIKey,
      locale: 'auto',
      token: function (stripeToken: any) {
        console.log(stripeToken);
        alert('Donation Done Successfully');
      },
    });
    paymentHandler.open({
      name: 'G I V E .com',
      description: 'Donation',
      email: this.form.value.email,
      amount: amount * 100,
    });
  } 

  showSuccessMessage = false;

  http = inject(HttpClient);

  form = new FormGroup({
    name: new FormControl('', [Validators.required, Validators.minLength(5)]),
    email: new FormControl('', [Validators.required, Validators.minLength(5)]),
    phoneNumber: new FormControl('', [
      Validators.required,
      Validators.min(999999999),
      Validators.max(9999999999),
    ]),
    amount: new FormControl('', [Validators.required, Validators.min(1)]),
  });

  get f() {
    return this.form.controls;
  }

  submit() {
    this.showSuccessMessage = false;
    this.http.post('http://127.0.0.1:8000/cards', this.form.value).subscribe(
      (res) => {
        this.makePayment(this.form.value.amount);
        console.log(res);
        this.form.reset();
        this.showSuccessMessage = true;
      },
      (err) => {
        console.error(err);
      }
    );
  }
}
