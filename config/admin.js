module.exports = ({ env }) => ({
  auth: {
    secret: env('ADMIN_JWT_SECRET', '35b4affe8f93c2f73bba1ff3d99bfc50'),
  },
});
