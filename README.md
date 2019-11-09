# IR-2019_Term_Project
Quizzes States
=
This project is to make a Quiznaire Application that uses Apache Solr to index and easily retrieve data to generate questions. 

Setting Up Solr Configuration
=
Start solr 7 and run:
    
    bin/solr create -c TermProject
    
If you are running Solr, stop it and then go into /server/solr/TermProject/conf/ and edit solrconfig.xml
Put near at the top of the document, where the other <lib dir> entries are, this line:
    
    <lib dir="${solr.install.dir:../../../..}/dist/" regex="solr-dataimporthandler-.*.jar" />

Also copy and paste the following, where you will need to change the "config tag" to match the location
of the data-config.xml file you will be making in the next step, into where the requestHandler entries are:

    <requestHandler name="/dataimport" class="org.apache.solr.handler.dataimport.DataImportHandler">
        <lst name="defaults">
            <str name="config">/path/to/my/DIHconfigfile.xml</str>
        </lst>
    </requestHandler>
    
Make a new file called "data-config.xml" and paste this into it. You will need to change the url line to match
the location of the downloaded wikifile (Wikipedia-20191102205313.xml) for this project.

    <dataConfig>
        <dataSource type="FileDataSource" encoding="UTF-8" />
        <document>
        <entity name="page"
                processor="XPathEntityProcessor"
                stream="true"
                forEach="/mediawiki/page/"
                url="/data/Wikipedia-20191102205313.xml"
                transformer="RegexTransformer,DateFormatTransformer"
                >
            <field column="id"        xpath="/mediawiki/page/id" />
            <field column="title"     xpath="/mediawiki/page/title" />
            <field column="revision"  xpath="/mediawiki/page/revision/id" />
            <field column="user"      xpath="/mediawiki/page/revision/contributor/username" />
            <field column="userId"    xpath="/mediawiki/page/revision/contributor/id" />
            <field column="text"      xpath="/mediawiki/page/revision/text" />
            <field column="timestamp" xpath="/mediawiki/page/revision/timestamp" dateTimeFormat="yyyy-MM-dd'T'hh:mm:ss'Z'" />
            <field column="$skipDoc"  regex="^#REDIRECT .*" replaceWith="true" sourceColName="text"/>
       </entity>
        </document>
    </dataConfig>
    
You should get a simple response header at http://localhost:8983/solr/TermProject/dataimport?command=full-import if you start up solr.
