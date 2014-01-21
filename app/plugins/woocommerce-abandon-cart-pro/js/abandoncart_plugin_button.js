(
        function(){
       
                tinymce.create(
                        "tinymce.plugins.abandoncart",
                        {
                                init: function(d,e) {},
                                createControl:function(d,e)
                                {
                               
                                        if(d=="abandoncart_email_variables"){
                                       
                                                d=e.createMenuButton( "abandoncart_email_variables",{
                                                        title:"Custom Fields",
                                                        icons:false
                                                        });
                                                       
                                                        var a=this;d.onRenderMenu.add(function(c,b){
                                                               
                                                               
                                                                a.addImmediate(b,"Customer First Name", '{{customer.firstname}}');
                                                                a.addImmediate(b,"Customer Last Name", '{{customer.lastname}}');
                                                                a.addImmediate(b,"Customer Full Name", '{{customer.fullname}}');
                                                                
																b.addSeparator();

                                                                a.addImmediate(b,"Customer e-mail address", '{{customer.email}}');
                                                                
																b.addSeparator();

                                                                a.addImmediate(b,"Date when Cart was abandoned", '{{cart.abandoned_date}}');
                                                               
                                                                b.addSeparator();
                                                                
                                                                a.addImmediate(b,"Coupon Code", '{{coupon.code}}');
                                                                
                                                                b.addSeparator();
                                                               
                                                                a.addImmediate(b,"Shop Name", '{{shop.name}}');
                                                                a.addImmediate(b,"Shop URL", '{{shop.url}}');
                                                               
                                                                b.addSeparator();
                                                               
                                                                a.addImmediate(b,"Product Information/Cart Content", '{{products.cart}}');
																a.addImmediate(b,"Checkout Link", '{{checkout.link}}');
																a.addImmediate(b,"Cart Link", '{{cart.link}}');
																
																b.addSeparator();
																
																//a.addImmediate(b,"Reminder For Cart Deletion", '{{delete.reminder}}');
																a.addImmediate(b,"Unsubscribe Link", '{{cart.unsubscribe}}');
                                                               
                                                        });
                                                return d
                                       
                                        } // End IF Statement
                                       
                                        return null
                                },
               
                                addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})}
                               
                        }
                );
               
                tinymce.PluginManager.add( "abandoncart", tinymce.plugins.abandoncart);
        }
)();