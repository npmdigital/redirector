/**
 * Creates symlinks for the multiple endpoints
 *
 * Requires npm, which is part of node.js <http://nodejs.org/>
 * To run:
 *   npm install
 *   grunt
 */
module.exports = function(grunt) {
  grunt.initConfig({
    custom_config: grunt.file.readJSON('.env.json'),
    pkg: grunt.file.readJSON('package.json'),
    paths: {
      shared: 'endpoints/shared',
      frontend: 'endpoints/frontend',
      backend: 'endpoints/backend',
      sass: 'includes/scss',
      css: 'includes/css',
      src: 'app/src',
      tests: 'app/tests',
      docs: 'docs',
      views: 'app/views',
      routes: 'app/routes.php',
      config: 'app/config'
    },

    chmod: {
        options: {
          mode: '777'
        },
        logs: {
          src: [
            'app/storage/',
            'app/storage/cache/',
            'app/storage/logs/',
            'app/storage/meta/',
            'app/storage/sessions/',
            'app/storage/views/',
          ]
        }
    },
    phpdocumentor: {
      dist: {
        options: {
          directory : '<%= paths.src %>',
          target : '<%= paths.docs %>'
        }
      }
    },
    shell: {
      migrate: {
        command: function() {
          return 'php artisan migrate';
        }
      },
      dbseed: {
        command: function() {
          return 'php artisan db:seed';
        }
      }
    },
    db_dump: {
      db: {
        options: {
          title: "<%= custom_config.DB_SCHEMA %>",
          host: "<%= custom_config.DB_HOST %>",
          database: "<%= custom_config.DB_SCHEMA %>",
          user: "<%= custom_config.DB_USERNAME %>",
          pass: "<%= custom_config.DB_PASSWORD %>",
          backup_to: "backups/<%= custom_config.DB_SCHEMA %>-<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>.sql"
        },
      }
    },
    notify: {
      composer: {
        options: {
          title: 'Composer',
          message: 'Update finished.'
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-chmod');
  grunt.loadNpmTasks('grunt-composer');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-symlink');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-mysql-dump');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-phpunit');
  grunt.loadNpmTasks('grunt-phpspec');
  grunt.loadNpmTasks('grunt-phpdocumentor');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-wiredep');
  grunt.loadNpmTasks('grunt-usemin');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('default', [
    'composer:install',
    'chmod',
    'shell:migrate',
    'shell:dbseed'
  ]);
  grunt.registerTask('release', [
    'composer:install',
    'chmod',
    'shell:migrate'
  ]);
  grunt.registerTask('composer-update', function(env) {
    grunt.task.run(['composer:update','notify:composer']);
  });
}
