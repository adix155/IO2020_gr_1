using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Cryptography.X509Certificates;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class DatabaseContext : DbContext
    {
        // połączenie z bazą danych
        public DatabaseContext(DbContextOptions<DatabaseContext> options) : base(options)
        {
            
        }
        public DbSet<Parameters> Params { get; set; }
        public DbSet<Patient> Patients { get; set; }
        public DbSet<RBHScale> RBHScales { get; set; }
        public DbSet<User> Users { get; set; }
    }
}
