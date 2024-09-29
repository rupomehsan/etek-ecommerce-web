
import { defineStore } from "pinia";

export const blog_store = defineStore("blog_store", {

    state: () => ({
        is_auth: 0,
        blog_data: {},
        single_blog_data: {},
        role: {},
    }),

    getters: {},
    actions: {

        get_all_blogs: async function (url = "/get-all-blogs") {
            try {
                let response = await axios.get(url);
                if (response.data.status === 'success') {
                    this.blog_data = response.data.data;
                }
                window.scrollTo({
                    top: 300,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.error('Error fetching blogs:', error);
            }
        },
        get_single_blog: async function (slug) {
            let response = await axios.get(`/get-single-blog/${slug}`);
            if (response.data.status == 'success') {
                this.single_blog_data = response.data.data;
            }
        },

        load_blogs: async function (link) {
            // console.log(link);
            try {
                let link_url = new URL(link.url);
                console.log("ss", link_url);
                let url = new URL(location.origin + `/api/v1/get-all-blogs`);
                url.searchParams.set('page', link_url.searchParams.get('page'));

                let res = await axios.get(url.href);
                this.blog_data = res.data.data;
                window.scrollTo({
                    top: 300,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.error('Error loading product:', error);
            }
        },


    },
});
