using System;
using System.Collections.Generic;
using System.Linq;
using System.Reflection.Metadata;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class SQLParametersRepository : IParametersRepository
    {
        private readonly DatabaseContext context;
        public SQLParametersRepository(DatabaseContext context)
        {
            this.context = context;
        }
        public Parameters Add(Parameters parameters)
        {
            context.Params.Add(parameters);
            context.SaveChanges();
            return parameters;
        }

        public Parameters Delete(int id)
        {
            Parameters parameters = context.Params.Find(id);
            if(parameters != null)
            {
                context.Params.Remove(parameters);
                context.SaveChanges();
            }
            return parameters;
        }

        public IEnumerable<Parameters> GetAllParameters()
        {
            return context.Params;
        }

        public Parameters GetParameters(int id)
        {
            return context.Params.Find(id);
        }

        public Parameters Update(Parameters paramsChanges)
        {
            var parameters = context.Params.Attach(paramsChanges);
            parameters.State = Microsoft.EntityFrameworkCore.EntityState.Modified;
            context.SaveChanges();
            return paramsChanges;
        }
    }
}
