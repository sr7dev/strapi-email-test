'use strict';

module.exports = {
  send: async (ctx) => {
    const {email} = ctx.request.body;
    console.log(ctx.request.body);
    try {
      var info = await strapi.plugins.email.services.email.send({
              to: 'j.perfectsolution55@gmail.com',
              from: 'your@email.address',
              replyTo: 'your@email.address',
              subject: 'It is my message',
              text: 'Coucou',
              html: 'Coucou'
            });
      console.log(info);
      ctx.send({ status: "success", message: "successfully!!!", data: info });
    }
    catch (err) {
      console.log(err);
      ctx.send({ status: "error", message: "failed", data: err });
      // ctx.send('error');
    }

  }
};
