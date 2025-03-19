import { defineStore } from "pinia";
import { useToast } from "vue-toastification";

const toast = useToast()

export const cart = defineStore("cart", {
    state: () => ({
        cart: []
    }),
    actions: {
        add(product) {
            if (this.cart[product.id]) {
                this.cart[product.id].quantity += product.quantity
            } else {
                this.cart[product.id] = JSON.parse(JSON.stringify(product))
            }

            toast.success(`${product.quantity} db "${product.name}" bekerült a kosaradba`, {
                timeout: 3000,
                hideProgressBar: true
            })
        },

        update(product) {
            this.cart[product.id] = product
        },

        remove(product) {
            this.cart = this.content.filter(item => item.id !== product.id)

            toast.success(`"${product.name}" törölve a kosaradból`, {
                timeout: 3000,
                hideProgressBar: true
            })
        },
        clear() {
            this.cart = []
        }
    },
    getters: {
        subtotal() {
            return this.content.reduce((total, product) => {
                return total + (product.price * product.quantity)
            }, 0)
        },
        shipping() {
            return 2000;
        },
        tax() {
            return (this.subtotal + this.shipping ) * 0.27;
        },
        total() {
            return this.subtotal + this.shipping + this.tax
        },
        count() {
            return this.content.length
        },

        content() {
            return this.cart.filter((item) => item != null)
        }
    },
    persist: true
})
