//Enter header here
#include <stdio.h>
#include "get_next_line.h";

int		count_size(t_list **head)
{
	//printf("count_size\n");
	t_list	*current;
	int		count;

	current = *head;
	count = 0;
	while (current != NULL)
	{
		count += current->content_size;
		current = current->next;
	}
	return (count);
}

int		make_line(char **line, t_list **head)
{
	//printf("make_line\n");
	t_list	*current;
	char 	*tempStr;
	size_t	tempInt;

	if (head == NULL)
		return (-1);
	*line = ft_strnew(count_size(head));
	current = *head;
	while (current != NULL && current->content != NULL)
	{
		if ((tempInt = ft_strsearch(current->content, '\n')) != -1)
		{
			tempStr = ft_strnew(tempInt);
			tempStr = ft_strncpy(tempStr, current->content, tempInt);
		}
		else
			tempStr = current->content;
		*line = ft_strjoin(*line, tempStr);
		current = current->next;
	}
	(*line)[count_size(head)] = '\0';
	return (count_size(head));
}

int		read_to_list(const int fd, t_list **head)
{
	static char	*save = NULL;
	char		*temp;
	char		buff[BUFF_SIZE];
	int 		readStatus;
	int			tempInt;
	t_list		*new;

	temp = ft_strnew(BUFF_SIZE + 1);
	readStatus = 1;
	if (save == NULL)
	{
		readStatus = read(fd, buff, BUFF_SIZE);
		ft_strcpy((char *)&buff, temp);
	}
	else
		ft_strcpy(save, temp);

	if (readStatus <= 0)
		return (readStatus);

	tempInt = ft_strsearch(temp, '\n');
	if (tempInt >= 0)
	{
		if (tempInt > 0)
			new = ft_lstnew(temp, tempInt + 1);
		if (tempInt != (BUFF_SIZE - 1))
		{
			save = ft_strnew(BUFF_SIZE - tempInt + 1);
			ft_strcpy(save, temp[tempInt + 1]);
		}
		//new line found and not at [0]
	}
	if (tempInt == -1)
		new = ft_lstnew(temp, ft_strlen(temp));
		//new line not found
	ft_lstadd(head, new);
}

int		get_next_line(const int fd, char **line)
{
	int		readStatus;
	int		makeStatus;
	t_list	*head;

	readStatus = 1;
	head = NULL;
	while (readStatus > 0)
	{
		readStatus = read_to_list(fd, &head);
	}
	makeStatus = make_line(line, &head);
	if (readStatus > 0 && makeStatus > 0)
		return (1);
	if (readStatus == 0 && makeStatus > 0)
		return (0);
	return (-1);
}