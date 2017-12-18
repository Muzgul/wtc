void	ft_lstclr(t_list **head)
{
	t_list	**current;
	t_list	**prev;

	current = *head;
	while (*head != NULL)
	{
		current = *head;
		prev = current;
		while (current->next != NULL)
		{
			prev = current;
			current = current->next;
		}
		if (current->content != NULL)
			ft_memdel(&current->content);
		ft_memdel(current);
		if (current == prev)
			*head = NULL;
	}
}
